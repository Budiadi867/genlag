<?php
// Random content template
?>
<div class="card">
    <div class="card-header">
        <h2>Pengelolaan Konten Acak</h2>
    </div>
    
    <div class="random-content-management">
        <!-- Title Management -->
        <div class="random-content-section">
            <h3>Judul Acak</h3>
            
            <?php if (isset($error_title)): ?>
                <div class="alert alert-danger"><?php echo $error_title; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success_title)): ?>
                <div class="alert alert-success"><?php echo $success_title; ?></div>
            <?php endif; ?>
            
            <!-- Add Title Form -->
            <form method="post" action="/random_content.php" class="content-form">
                <div class="form-group">
                    <label for="title">Tambah Judul Acak</label>
                    <input type="text" id="title" name="title" placeholder="Masukkan judul baru" required>
                    <button type="submit" name="add_title" class="btn btn-primary">Tambah</button>
                </div>
            </form>
            
            <!-- Title List -->
            <div class="content-list">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($titles)): ?>
                            <tr>
                                <td colspan="3" class="no-content">Tidak ada judul acak.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($titles as $index => $title): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($title); ?></td>
                                    <td>
                                        <form method="post" action="/random_content.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus judul ini?');">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <button type="submit" name="delete_title" class="btn btn-small btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Description Management -->
        <div class="random-content-section">
            <h3>Deskripsi Acak</h3>
            
            <?php if (isset($error_desc)): ?>
                <div class="alert alert-danger"><?php echo $error_desc; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success_desc)): ?>
                <div class="alert alert-success"><?php echo $success_desc; ?></div>
            <?php endif; ?>
            
            <!-- Add Description Form -->
            <form method="post" action="/random_content.php" class="content-form">
                <div class="form-group">
                    <label for="description">Tambah Deskripsi Acak</label>
                    <textarea id="description" name="description" placeholder="Masukkan deskripsi baru" required rows="3"></textarea>
                    <button type="submit" name="add_description" class="btn btn-primary">Tambah</button>
                </div>
            </form>
            
            <!-- Description List -->
            <div class="content-list">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($descriptions)): ?>
                            <tr>
                                <td colspan="3" class="no-content">Tidak ada deskripsi acak.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($descriptions as $index => $description): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($description); ?></td>
                                    <td>
                                        <form method="post" action="/random_content.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus deskripsi ini?');">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <button type="submit" name="delete_description" class="btn btn-small btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
