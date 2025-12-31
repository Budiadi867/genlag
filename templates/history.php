<?php
// History template
?>
<div class="card">
    <div class="card-header">
        <h2>Histori URL yang Dihasilkan</h2>
    </div>
    
    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
    
    <div class="url-history">
        <?php if (empty($urls)): ?>
            <p class="no-urls">Belum ada URL yang dihasilkan.</p>
        <?php else: ?>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>URL</th>
                        <th>Judul</th>
                        <th>URL Tujuan</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($urls as $index => $url): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td>
                                <?php 
                                // Reconstruct the URL
                                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                                $host = !empty($url['subdomain']) ? $url['subdomain'] . '.' . DOMAIN : DOMAIN;
                                $fullUrl = sprintf("%s://%s/s/%s?tr=%s&deb=%s", 
                                                $protocol, $host, $url['slug'], $url['tracking'], $url['debug']);
                                ?>
                                <input type="text" value="<?php echo htmlspecialchars($fullUrl); ?>" readonly class="history-url">
                                <button class="copy-btn" data-clipboard-text="<?php echo htmlspecialchars($fullUrl); ?>">Salin</button>
                            </td>
                            <td><?php echo htmlspecialchars($url['title']); ?></td>
                            <td>
                                <a href="<?php echo htmlspecialchars($url['final_url']); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo htmlspecialchars(substr($url['final_url'], 0, 30) . (strlen($url['final_url']) > 30 ? '...' : '')); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($url['created_at'] ?? 'N/A'); ?></td>
                            <td>
                                <a href="/s/<?php echo htmlspecialchars($url['slug']); ?>" target="_blank" class="btn btn-small btn-info">Lihat</a>
                                <form method="post" action="/delete_url.php" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus URL ini?');">
                                    <input type="hidden" name="slug" value="<?php echo htmlspecialchars($url['slug']); ?>">
                                    <button type="submit" class="btn btn-small btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize clipboard.js for all copy buttons
        var clipboard = new ClipboardJS('.copy-btn');
        
        clipboard.on('success', function(e) {
            var button = e.trigger;
            var originalText = button.textContent;
            
            // Change button text
            button.textContent = 'Disalin!';
            
            // Reset button text after 2 seconds
            setTimeout(function() {
                button.textContent = originalText;
            }, 2000);
            
            e.clearSelection();
        });
    });
</script>
