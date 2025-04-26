<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tailwind Styled DataTable</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <style>
    body {
      font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    table.dataTable thead th {
      @apply bg-gray-100 text-gray-700 text-sm font-semibold uppercase tracking-wide px-4 py-3;
    }
    table.dataTable tbody td {
      @apply px-4 py-2 text-gray-800 text-sm;
    }
    .dataTables_wrapper .dataTables_filter input {
      @apply border border-gray-300 rounded px-3 py-1 text-sm;
    }
    .dataTables_wrapper .dataTables_length select {
      @apply border border-gray-300 rounded px-2 py-1 text-sm;
    }
  </style>
</head>
<body class="bg-gray-100 p-10">

  <div class="bg-white shadow-md rounded-xl p-6 max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">User Table</h2>
    <div class="overflow-x-auto">
      <table id="myTable" class="stripe hover w-full text-left rounded-lg overflow-hidden">
        <thead>
          <tr>
            <th>Sno</th>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($files as $index=> $media)
            <tr>
              <td>{{ ++$index }}</td>
              <td>{{ $media->title }}</td>
              <td>
                <a href="{{ route('file.show', $media->id) }}" class="text-yellow-600 font-bold hover:underline mr-2">View</a>    
                <a href="{{ route('file.edit', $media->id) }}" class="text-blue-600 font-bold hover:underline mr-2">Edit</a>    
                <form action="{{ route('file.destroy', $media->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 font-bold hover:underline">Delete</button>
                </form>
            </td>
            </tr>
                
            @endforeach

        </tbody>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

</body>
</html>
