<?php
// Generator template
?>
<div class="card">
    <div class="card-header">
        <h2>Generator URL untuk Facebook</h2>
    </div>
    
    <form id="urlGeneratorForm" method="post" action="generator.php">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <div class="form-group">
        <label for="title">Judul (Title)</label>
        <input type="text" id="title" name="title" placeholder="Masukkan judul atau biarkan kosong untuk judul acak"
               value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
    </div>

    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="3" placeholder="Masukkan deskripsi atau biarkan kosong untuk deskripsi acak"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
    </div>

    <div class="form-group">
        <label for="imageUrl">URL Gambar</label>
        <input type="url" id="imageUrl" name="imageUrl" placeholder="https://example.com/image.jpg" required
               value="<?php echo isset($_POST['imageUrl']) ? htmlspecialchars($_POST['imageUrl']) : ''; ?>">
    </div>

    <div class="form-group">
        <label for="finalUrl">URL Tujuan (Final URL)</label>
        <input type="url" id="finalUrl" name="finalUrl" placeholder="https://example.com/landing-page" required
               value="<?php echo isset($_POST['finalUrl']) ? htmlspecialchars($_POST['finalUrl']) : ''; ?>">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="generate">Generate URL</button>
    </div>
</form>

    
    <?php if (isset($generatedUrl)): ?>
    <div class="result-box">
        <h3>URL yang Dihasilkan:</h3>
        <input type="text" id="generatedUrl" value="<?php echo htmlspecialchars($generatedUrl); ?>" readonly style="width: 100%; margin-bottom: 10px;">
        <button id="copyBtn" class="copy-btn">Salin URL</button>
        <p id="copyMessage" style="display: none; color: green; margin-top: 5px;"></p>
    </div>
    <?php endif; ?>
</div>
