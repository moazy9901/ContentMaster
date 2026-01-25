<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Export PDF</title>
    <style>
        body {
             font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <h2>العملاء</h2>
    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>الهاتف</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>المالكون</h2>
    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>الهاتف</th>
                <th>العمر</th>
            </tr>
        </thead>
        <tbody>
            @foreach($owners as $owner)
                <tr>
                    <td>{{ $owner->name }}</td>
                    <td>{{ $owner->email }}</td>
                    <td>{{ $owner->phone }}</td>
                    <td>{{ $owner->age }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>المدراء</h2>
    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>الهاتف</th>
                <th>العنوان</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone }}</td>
                    <td>{{ $admin->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>