<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-light">
<div class="container my-5">
    <h1 class="text-center mb-4">List of Tests</h1>
    <div class="text-end mb-3">
        <a href="<?= site_url('test/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Test
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Download</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($tests) && is_array($tests)): ?>
                <?php foreach ($tests as $test): ?>
                    <tr>
                        <td><?= esc($test['id']) ?></td>
                        <td><?= esc($test['name']) ?></td>
                        <td><?= esc($test['created_at']) ?></td>
                        <td><?= esc($test['updated_at']) ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('test/edit/' . $test['id']) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="<?= site_url('test/delete/' . $test['id']) ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this record?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="<?= site_url('test/downloadXML/' . $test['id']) ?>"
                               class="btn btn-secondary btn-sm">
                                <i class="fas fa-file-download"></i> Export XML
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No records found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
