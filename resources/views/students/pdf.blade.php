<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 12px;
        }
        .header {
            margin-bottom: 14px;
        }
        .title {
            margin: 0;
            font-size: 20px;
            color: #14532d;
        }
        .meta {
            margin-top: 4px;
            color: #4b5563;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #dcfce7;
            color: #14532d;
        }
        .empty {
            margin-top: 12px;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f9fafb;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Student Information System Report</h1>
        <div class="meta">Generated: {{ $generatedAt }}</div>
        <div class="meta">Total Records: {{ $students->count() }}</div>
    </div>

    @if($students->isEmpty())
        <div class="empty">No student records found for the current filter.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->course }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
