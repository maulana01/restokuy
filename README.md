Apa saja yang dipindahkan?
semua file tampilan yang ada sebelumnya dipindahkan ke folder ../restokuy/public/__tampilan/

Bagaimana jika ingin buat baru/edit atau test halaman tampilan?
Tidak ada perubahan layaknya tidak menggunakan Codeigniter, hanya saja untuk akses ke halaman tampilan langsung tanpa ada ikut campur dari Codeigniter, kunjungi : http://localhost/restokuy/public/__tampilan/<nama file halaman>.(php/html)

Apa saja yang ditambahkan?
+ Added Codeigniter 4.1.3 Base.
+ Moved all previous files into ../restokuy/public/__tampilan/ folder
+ Renamed 'env' file to '.env'
+ Modified CI_ENVIRONMENT from production to development in ../restokuy/.env
+ Modified default database settings in ../restokuy/.env
+ Modified $baseURL in ../restokuy/app/Config/App.php
+ Modified $indexPage in ../restokuy/app/Config/App.php
+ Changed $uriProtocol from 'REQUEST_URI' to 'PATH_INFO' in ../restokuy/app/Config/App.php
+ Changed $routes->setAutoRoute from True to False in ../restokuy/app/Config/Routes.php
+ Added NoAdminFilter in ../restokuy/app/Filters/NoAdminFilter.php
+ Added SessionFilter in ../restokuy/app/Filters/SessionFilter.php
+ Added NoAdminFilter, SessionFilter Reference in ../restokuy/app/Config/Filters.php
+ Added 'noadmin', 'visitor' into $aliases in ../restokuy/app/Config/Filters.php
+ Modified Home::index Controller.
+ Added Sistem Controller.
+ Added Sistem::login Controller.
+ Added Sistem::logout Controller.
+ Added $routes->match, get/post, 'xyz/new', Sistem::adminBaru, filter => noadmin:noreturn.
+ Added $routes->match, get/post, 'login', Sistem::login, filter => visitor:login.
+ Added $routes->get, 'logout', Sistem::logout, filter => noadmin.