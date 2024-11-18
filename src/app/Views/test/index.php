<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<h1>List of Tests</h1>

<a href="<?= site_url('test/create') ?>" class="btn btn-primary">Create New Test</a>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>created date</th>
        <th>updated date</th>
        <th>edit</th>
        <th>delete</th>
        <th>download</th>
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
                <td>
                    <a href="<?= site_url('test/edit/'.$test['id']) ?>" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="<?= site_url('test/delete/'.$test['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
                <td>
                    <a href="<?= site_url('test/downloadXML/'.$test['id']) ?>" class="btn btn-secondary">Export XML</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No records found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
