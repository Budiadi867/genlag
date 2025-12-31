<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Trang Tin Tức Việt Nam</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #ffffff;
      color: #111111;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-white text-gray-900">
  <header class="bg-black text-white p-8 shadow-lg">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-4xl font-extrabold mb-2">Tin Tức Việt Nam</h1>
      <p class="text-lg text-gray-300">Cập nhật tin tức mới nhất về Việt Nam</p>
    </div>
  </header>
  <section class="relative bg-gray-900 text-white py-16">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-4">Tin Nổi Bật</h2>
      <p class="text-gray-300 max-w-xl mx-auto">
        Những tin tức quan trọng và đáng chú ý nhất về Việt Nam trong thời gian gần đây.
      </p>
    </div>
  </section>
  <main class="flex-grow max-w-4xl mx-auto p-6 grid gap-8 sm:grid-cols-1 md:grid-cols-2">
    <article class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300 flex flex-col sm:flex-row gap-4">
      <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Kinh tế Việt Nam" class="w-full sm:w-40 h-24 object-cover rounded-md flex-shrink-0" />
      <div class="flex flex-col">
        <h2 class="text-xl font-semibold mb-2">Việt Nam tăng trưởng kinh tế mạnh mẽ trong quý 1 năm 2024</h2>
        <time datetime="2024-04-15" class="text-xs text-gray-600">15 Tháng 4, 2024</time>
        <p class="mt-2 text-gray-800 text-sm">
          Theo báo cáo mới nhất, nền kinh tế Việt Nam đã đạt mức tăng trưởng 6.5% trong quý đầu tiên của năm 2024, vượt qua dự báo của các chuyên gia.
        </p>
      </div>
    </article>
    <article class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300 flex flex-col sm:flex-row gap-4">
      <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=400&q=80" alt="Năng lượng tái tạo" class="w-full sm:w-40 h-24 object-cover rounded-md flex-shrink-0" />
      <div class="flex flex-col">
        <h2 class="text-xl font-semibold mb-2">Chính phủ Việt Nam thúc đẩy phát triển năng lượng tái tạo</h2>
        <time datetime="2024-04-10" class="text-xs text-gray-600">10 Tháng 4, 2024</time>
        <p class="mt-2 text-gray-800 text-sm">
          Việt Nam đặt mục tiêu tăng tỷ lệ năng lượng tái tạo lên 30% tổng sản lượng điện vào năm 2030 nhằm bảo vệ môi trường và phát triển bền vững.
        </p>
      </div>
    </article>
    <article class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300 flex flex-col sm:flex-row gap-4">
      <img src="https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?auto=format&fit=crop&w=400&q=80" alt="Du lịch Việt Nam" class="w-full sm:w-40 h-24 object-cover rounded-md flex-shrink-0" />
      <div class="flex flex-col">
        <h2 class="text-xl font-semibold mb-2">Du lịch Việt Nam phục hồi mạnh mẽ sau đại dịch</h2>
        <time datetime="2024-04-05" class="text-xs text-gray-600">5 Tháng 4, 2024</time>
        <p class="mt-2 text-gray-800 text-sm">
          Ngành du lịch Việt Nam ghi nhận sự tăng trưởng ấn tượng với lượng khách quốc tế tăng 40% so với cùng kỳ năm trước.
        </p>
      </div>
    </article>
    <article class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300 flex flex-col sm:flex-row gap-4">
      <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=400&q=80" alt="Hiệp định thương mại" class="w-full sm:w-40 h-24 object-cover rounded-md flex-shrink-0" />
      <div class="flex flex-col">
        <h2 class="text-xl font-semibold mb-2">Việt Nam ký kết nhiều hiệp định thương mại quốc tế mới</h2>
        <time datetime="2024-04-01" class="text-xs text-gray-600">1 Tháng 4, 2024</time>
        <p class="mt-2 text-gray-800 text-sm">
          Các hiệp định thương mại mới giúp mở rộng thị trường xuất khẩu và thúc đẩy hợp tác kinh tế giữa Việt Nam và các đối tác quốc tế.
        </p>
      </div>
    </article>
    <article class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
      <h2 class="text-xl font-semibold mb-2">Hội nghị quốc tế về biến đổi khí hậu tại Việt Nam</h2>
      <time datetime="2024-03-28" class="text-xs text-gray-600">28 Tháng 3, 2024</time>
      <p class="mt-2 text-gray-800 text-sm">
        Việt Nam đăng cai tổ chức hội nghị quốc tế nhằm thảo luận các giải pháp ứng phó với biến đổi khí hậu và bảo vệ môi trường.
      </p>
    </article>
    <article class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
      <h2 class="text-xl font-semibold mb-2">Phát triển công nghệ 5G tại các thành phố lớn</h2>
      <time datetime="2024-03-20" class="text-xs text-gray-600">20 Tháng 3, 2024</time>
      <p class="mt-2 text-gray-800 text-sm">
        Các nhà mạng tại Việt Nam đang đẩy mạnh triển khai công nghệ 5G nhằm nâng cao chất lượng dịch vụ và kết nối internet tốc độ cao.
      </p>
    </article>
    <article class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
      <h2 class="text-xl font-semibold mb-2">Giải bóng đá quốc gia thu hút sự quan tâm lớn</h2>
      <time datetime="2024-03-15" class="text-xs text-gray-600">15 Tháng 3, 2024</time>
      <p class="mt-2 text-gray-800 text-sm">
        Giải bóng đá quốc gia Việt Nam năm 2024 thu hút đông đảo người hâm mộ với nhiều trận đấu kịch tính và hấp dẫn.
      </p>
    </article>
  </main>
  <footer class="bg-black text-white p-6 text-center text-sm">
    &copy; 2024 Trang Tin Tức Việt Nam. Bản quyền thuộc về tác giả.
  </footer>
</body>
</html>
