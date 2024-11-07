@extends('layouts.backend')

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12">
            <h3>Database Backup Files</h3>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body">
        <div class="col-sm-12">
            <table class="datatable table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Size (KB)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($files as $file)
                        <tr>
                            <td>{{ $file->getFilename() }}</td>
                            <td>{{ round($file->getSize() / 1024, 2) }}</td>
                            <td>
                                <a href="{{ route('download_backup', $file->getFilename()) }}" class="btn btn-primary download-backup-btn mr-1">Download</a>
                                <a href="#" class="btn btn-danger mb-1 delete-backup-btn">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No backup files available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.delete-backup-btn', function(e) {
            e.preventDefault(); // Prevent the default action (navigation)

            var url = $(this).attr('href'); // Get the URL from the href attribute

            Swal.fire({
                title: 'Are you sure you want to delete it?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Success!", "Deleted successfully", "success");
                    // If confirmed, proceed with the deletion
                    setTimeout(() => {
                        window.location.href = url;
                    }, 1500)
                }
            });
        });
</script>
@endsection
