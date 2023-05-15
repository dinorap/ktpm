function addbar() {
  document.write(`
<div class="iq-sidebar">
  <div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="admin-dashboard.html" class="header-logo">
      <img src="images/logo.png" class="img-fluid rounded-normal" alt="" />
      <div class="logo-title">
        <span class="text-primary text-uppercase">ADMIN REVIEW BOOK</span>
      </div>
    </a>
  </div>
  <div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
      <ul id="iq-sidebar-toggle" class="iq-menu">
      <li>
      <a href="admin-dashboard.html">
        <i class="ri-home-2-line"></i>Bảng Điều Khiển
      </a>
    </li>
    <li>
      <a href="admin-category.html">
        <i class="ri-bookmark-line"></i>Danh Mục Sách
      </a>
    </li>
    <li>
      <a href="admin-author.html">
        <i class="ri-pencil-line"></i>Tác Giả
      </a>
    </li>
    <li>
      <a href="admin-books.html">
        <i class="ri-book-line"></i>Sách
      </a>  
    </li>
    <li>
      <a href="javascript:history.back()">
        <i class="ri-user-line"></i>Tài Khoản
      </a>
    </li>
    <li>
      <a href="../index.html">
        <i class="ri-logout-box-line ml"></i>Đăng Xuất
      </a>
    </li>
      </ul>
    </nav>
    <div id="sidebar-bottom" class="p-3 position-relative">
      <div class="iq-card">
        <div class="iq-card-body">
          <div class="sidebarbottom-content"></div>
        </div>
      </div>
    </div>
  </div>
</div>;`);
}
