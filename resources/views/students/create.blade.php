<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        :root {
            --green-dark: #14532d;
            --green-main: #15803d;
            --green-soft: #dcfce7;
            --bg: #f7faf8;
            --text: #1f2937;
            --white: #ffffff;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        .container {
            max-width: 620px;
            margin: 40px auto;
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        }
        h2 {
            margin-top: 0;
            color: var(--green-dark);
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #f9fafb;
        }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 8px;
        }
        .btn {
            text-decoration: none;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            color: var(--white);
            cursor: pointer;
            font-size: 14px;
        }
        .btn-save { background: var(--green-main); }
        .btn-back { background: #4b5563; }
        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Student</h2>

        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/students">
            @csrf

            <label>First Name:</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required>

            <label>Age:</label>
            <input type="number" name="age" value="{{ old('age') }}" min="1" required>

            <label>Course:</label>
            <input type="text" name="course" value="{{ old('course') }}" required>

            <div class="actions">
                <button class="btn btn-save" type="submit">Save</button>
                <a class="btn btn-back" href="/students">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
