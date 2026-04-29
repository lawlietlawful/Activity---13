<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        [$sort, $direction] = $this->resolveSortInputs();
        $query = $this->buildFilteredQuery();
        $students = $query->orderBy($sort, $direction)->paginate(5)->withQueryString();
        $courses = Student::select('course')->distinct()->orderBy('course')->pluck('course');

        return view('students.index', compact('students', 'courses'));
    }

    public function exportCsv()
    {
        [$sort, $direction] = $this->resolveSortInputs();
        $students = $this->buildFilteredQuery()->orderBy($sort, $direction)->get();
        $filename = 'students_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($students) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['First Name', 'Last Name', 'Age', 'Course']);

            foreach ($students as $student) {
                fputcsv($handle, [
                    $student->first_name,
                    $student->last_name,
                    $student->age,
                    $student->course,
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function exportPdf()
    {
        [$sort, $direction] = $this->resolveSortInputs();
        $students = $this->buildFilteredQuery()->orderBy($sort, $direction)->get();

        $pdf = Pdf::loadView('students.pdf', [
            'students' => $students,
            'generatedAt' => now()->format('F d, Y h:i A'),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('students_' . now()->format('Ymd_His') . '.pdf');
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'course' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect('/students')->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'course' => 'required|string|max:255',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validated);

        return redirect('/students')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully.');
    }

    private function buildFilteredQuery()
    {
        $query = Student::query();

        if (request()->filled('q')) {
            $search = request('q');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('course', 'like', '%' . $search . '%');
            });
        }

        if (request()->filled('course')) {
            $query->where('course', request('course'));
        }

        return $query;
    }

    private function resolveSortInputs()
    {
        $sortableColumns = ['first_name', 'last_name', 'age', 'course'];
        $sort = request('sort', 'id');
        $direction = request('direction', 'desc');

        if (!in_array($sort, $sortableColumns, true)) {
            $sort = 'id';
        }

        if (!in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'desc';
        }

        return [$sort, $direction];
    }
}
