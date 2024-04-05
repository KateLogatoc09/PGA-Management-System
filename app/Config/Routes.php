<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //FIRST PAGE
$routes->get('/', 'Home::index');

//PAGES BEFORE LOGIN
$routes->get('/login', 'Home::logreg', ['filter' => 'loggedin']);
$routes->get('/reg', 'Home::reg', ['filter' => 'loggedin']);
$routes->get('/about', 'Home::ab');
$routes->get('/verify', 'Home::verify', ['filter' => 'loggedin']);
$routes->get('/verifying', 'Home::verifying', ['filter' => 'verify']);
$routes->get('/forgot', 'Home::forgot', ['filter' => 'loggedin']);
$routes->get('/password', 'Home::password', ['filter' => 'password']);
$routes->get('/qr-generator', 'Home::qr');

//ATTENDANCE
$routes->post('/generate', 'Attendance::simple_qr');
$routes->post('/time_in', 'Attendance::time_in');
$routes->post('/time_out', 'Attendance::time_out');
$routes->get('/attendance_in', 'Attendance::attendance_in');
$routes->get('/attendance_out', 'Attendance::attendance_out');

//ADMIN FIRSTPAGE
$routes->get('/admins', 'AdminController::index', ['filter' => 'admin']);

//ADMIN ALUMNI
$routes->get('/alumni', 'AdminController::alumni', ['filter' => 'admin']);
$routes->post('/saveAlumni', 'AdminController::saveAlumni', ['filter' => 'admin']);
$routes->get('/deleteAlumni/(:any)', 'AdminController::deleteAlumni/$1', ['filter' => 'admin']);
$routes->get('/editAlumni/(:any)', 'AdminController::editAlumni/$1', ['filter' => 'admin']);

//ADMIN MAIL
$routes->get('/email', 'AdminController::mail', ['filter' => 'admin']);

//ADMIN ACADEMIC INFO
$routes->get('/sections', 'AdminController::sections', ['filter' => 'admin']);
$routes->post('/saveSection', 'AdminController::saveSection', ['filter' => 'admin']);
$routes->get('/deleteSection/(:any)', 'AdminController::deleteSection/$1', ['filter' => 'admin']);
$routes->get('/editSection/(:any)', 'AdminController::editSection/$1', ['filter' => 'admin']);
$routes->get('/subjects', 'AdminController::subjects', ['filter' => 'admin']);
$routes->post('/saveSubject', 'AdminController::saveSubject', ['filter' => 'admin']);
$routes->get('/deleteSubject/(:any)', 'AdminController::deleteSubject/$1', ['filter' => 'admin']);
$routes->get('/editSubject/(:any)', 'AdminController::editSubject/$1', ['filter' => 'admin']);

//ADMIN STUDENT
$routes->get('/adminstudent', 'AdminController::adminstudent', ['filter' => 'admin']);
$routes->get('/adminstudinfo', 'AdminController::adminstudinfo', ['filter' => 'admin']);
$routes->post('/adminfamily', 'AdminController::adminfamily', ['filter' => 'admin']);
$routes->post('/adminaddress', 'AdminController::adminaddress', ['filter' => 'admin']);
$routes->post('/saveLearner', 'AdminController::saveLearner', ['filter' => 'admin']);
$routes->post('/adminadmissions', 'AdminController::adminadmissions', ['filter' => 'admin']);
$routes->get('/deleteAdmissions/(:any)', 'AdminController::deleteAdmissions/$1', ['filter' => 'admin']);
$routes->get('/editAdmissions/(:any)', 'AdminController::editAdmissions/$1', ['filter' => 'admin']);
$routes->get('/deleteLearner/(:any)', 'AdminController::deleteLearner/$1', ['filter' => 'admin']);
$routes->get('/editLearner/(:any)', 'AdminController::editLearner/$1', ['filter' => 'admin']);
$routes->get('/deletefamily/(:any)', 'AdminController::deletefamily/$1', ['filter' => 'admin']);
$routes->get('/editfamily/(:any)', 'AdminController::editfamily/$1', ['filter' => 'admin']);
$routes->get('/deleteaddress/(:any)', 'AdminController::deleteaddress/$1', ['filter' => 'admin']);
$routes->get('/editaddress/(:any)', 'AdminController::editaddress/$1', ['filter' => 'admin']);
$routes->get('/admininfoaddress', 'AdminController::admininfoaddress', ['filter' => 'admin']);
$routes->get('/admininfoadmissions', 'AdminController::admininfoadmissions', ['filter' => 'admin']);
$routes->get('/admininfosibling', 'AdminController::admininfosibling', ['filter' => 'admin']);
$routes->post('/adminsibling', 'AdminController::adminsibling', ['filter' => 'admin']);
$routes->get('/deletesibling/(:any)', 'AdminController::deletesibling/$1', ['filter' => 'admin']);
$routes->get('/editsibling/(:any)', 'AdminController::editsibling/$1', ['filter' => 'admin']);
$routes->get('/adminschool', 'AdminController::adminschool', ['filter' => 'admin']);
$routes->post('/adminSaveschool', 'AdminController::adminSaveschool', ['filter' => 'admin']);
$routes->get('/adminDeleteschool/(:any)', 'AdminController::adminDeleteschool/$1', ['filter' => 'admin']);
$routes->get('/adminEditschool/(:any)', 'AdminController::adminEditschool/$1', ['filter' => 'admin']);

//ADMIN MANAGE ACCOUNTS
$routes->post('/saveAccount', 'AdminController::saveAccount', ['filter' => 'admin']);
$routes->get('/deleteAccount/(:any)', 'AdminController::deleteAccount/$1', ['filter' => 'admin']);
$routes->get('/editAccount/(:any)', 'AdminController::editAccount/$1', ['filter' => 'admin']);

//ADMIN TEACHER
$routes->get('/addTeacher', 'AdminController::addTeacher', ['filter' => 'admin']);
$routes->get('/teach/(:any)', 'AdminController::teach/$1', ['filter' => 'admin']);
$routes->post('/saveteacher', 'AdminController::save', ['filter' => 'admin']);
$routes->get('/deleteteacher/(:any)', 'AdminController::delete/$1', ['filter' => 'admin']);
$routes->get('/editteacher/(:any)', 'AdminController::edit/$1', ['filter' => 'admin']);

//TEACHER
$routes->get('/teacher', 'TeacherController::teacher', ['filter' => 'teacher']);
$routes->post('/teachersave', 'TeacherController::teachersave', ['filter' => 'teacher']);
$routes->get('/teacherinfo', 'TeacherController::teacherinfo', ['filter' => 'teacher']);
$routes->get('/grade', 'TeacherController::grade', ['filter' => 'teacher']);
$routes->post('/saveGrade', 'TeacherController::saveGrade', ['filter' => 'teacher']);
$routes->get('/deleteGrade/(:any)', 'TeacherController::deleteGrade/$1', ['filter' => 'teacher']);
$routes->get('/editGrade/(:any)', 'TeacherController::editGrade/$1', ['filter' => 'teacher']);

//ADMIN ENROLL
$routes->get('/enroll', 'AdminController::enroll', ['filter' => 'admin']);
$routes->get('/deleteenroll/(:any)', 'AdminController::delete/$1', ['filter' => 'admin']);
$routes->get('/editenroll/(:any)', 'AdminController::edit/$1', ['filter' => 'admin']);

//STUDENT GRADE
$routes->get('/graph', 'GradeController::index', ['filter' => 'student']);

//STUDENT PROFILE
$routes->get('/student', 'StudentController::index', ['filter' => 'student']);
$routes->get('/studentlibrary', 'StudentController::studentlibrary', ['filter' => 'student']);
$routes->post('/studentborrowBook', 'StudentController::studentborrowBook', ['filter' => 'student']);

//STUDENT ENROLL
$routes->get('/addenroll', 'EnrollmentController::addenroll', ['filter' => 'student']);
$routes->get('/confirm', 'EnrollmentController::confirm', ['filter' => 'student']);
$routes->get('/enroll/(:any)', 'EnrollmentController::enroll/$1', ['filter' => 'student']);
$routes->post('/save', 'EnrollmentController::save', ['filter' => 'student']);
$routes->post('/savefamily', 'EnrollmentController::savefamily', ['filter' => 'student']);
$routes->post('/saveaddress', 'EnrollmentController::saveaddress', ['filter' => 'student']);
$routes->post('/saveadmissions', 'EnrollmentController::saveadmissions', ['filter' => 'student']);
$routes->post('/savesibling', 'EnrollmentController::savesibling', ['filter' => 'student']);
$routes->post('/saveschool', 'EnrollmentController::saveschool', ['filter' => 'student']);

//AUTHENTICATION
$routes->post('/registering', 'Authentication::Register', ['filter' => 'loggedin']);
$routes->get('/logout', 'Authentication::Logout');
$routes->post('/authenticate', 'Authentication::LoginAuth', ['filter' => 'loggedin']);

//VERIFICATION
$routes->post('/sending', 'Authentication::sending', ['filter' => 'loggedin']);
$routes->post('/resend', 'Authentication::resend', ['filter' => 'loggedin']);
$routes->post('/checking', 'Authentication::checking', ['filter' => 'loggedin']);
$routes->post('/recovery', 'Authentication::recovery', ['filter' => 'loggedin']);
$routes->post('/recovering', 'Authentication::recovering', ['filter' => 'loggedin']);

//LIBRARIAN
$routes->post('/saveBook', 'LibraryController::saveBook', ['filter' => 'librarian']);
$routes->post('/saveBorrowedBook', 'LibraryController::saveBorrowedBook', ['filter' => 'librarian']);
$routes->get('/librarian', 'LibraryController::librarian', ['filter' => 'librarian']);
$routes->get('/deleteBorrow/(:any)', 'LibraryController::deleteBorrow/$1', ['filter' => 'librarian']);
$routes->get('/editBorrow/(:any)', 'LibraryController::editBorrow/$1', ['filter' => 'librarian']);
$routes->get('/deleteBook/(:any)', 'LibraryController::deleteBook/$1', ['filter' => 'librarian']);
$routes->get('/editBook/(:any)', 'LibraryController::editBook/$1', ['filter' => 'librarian']);
$routes->get('/books', 'LibraryController::books', ['filter' => 'librarian']);
$routes->get('/borrowers', 'LibraryController::borrowers', ['filter' => 'librarian']);

//PARENTS
$routes->get('/parent', 'ParentController::parent', ['filter' => 'parents']);

//REGISTRAR
$routes->get('/registrar', 'RegistrarController::registrar', ['filter' => 'registrar']);
$routes->get('/reggrade', 'RegistrarController::reggrade', ['filter' => 'registrar']);
$routes->get('/registerstudent', 'RegistrarController::registerstudent', ['filter' => 'registrar']);
$routes->post('/regSaveLearner', 'RegistrarController::regSaveLearner', ['filter' => 'registrar']);
$routes->get('/regDeleteLearner/(:any)', 'RegistrarController::regDeleteLearner/$1', ['filter' => 'registrar']);
$routes->get('/regEditLearner/(:any)', 'RegistrarController::regEditLearner/$1', ['filter' => 'registrar']);
$routes->get('/regfam', 'RegistrarController::regfam', ['filter' => 'registrar']);
$routes->post('/regSavefamily', 'RegistrarController::regSavefamily', ['filter' => 'registrar']);
$routes->get('/regDeletefamily/(:any)', 'RegistrarController::regDeletefamily/$1', ['filter' => 'registrar']);
$routes->get('/regEditfamily/(:any)', 'RegistrarController::regEditfamily/$1', ['filter' => 'registrar']);
$routes->get('/regaddress', 'RegistrarController::regaddress', ['filter' => 'registrar']);
$routes->post('/regSaveaddress', 'RegistrarController::regSaveaddress', ['filter' => 'registrar']);
$routes->get('/regDeleteaddress/(:any)', 'RegistrarController::regDeleteaddress/$1', ['filter' => 'registrar']);
$routes->get('/regEditaddress/(:any)', 'RegistrarController::regEditaddress/$1', ['filter' => 'registrar']);
$routes->get('/regsibling', 'RegistrarController::regsibling', ['filter' => 'registrar']);
$routes->post('/regSavesibling', 'RegistrarController::regSavesibling', ['filter' => 'registrar']);
$routes->get('/regDeletesibling/(:any)', 'RegistrarController::regDeletesibling/$1', ['filter' => 'registrar']);
$routes->get('/regEditsibling/(:any)', 'RegistrarController::regEditsibling/$1', ['filter' => 'registrar']);
$routes->get('/regschool', 'RegistrarController::regschool', ['filter' => 'registrar']);
$routes->post('/regSaveschool', 'RegistrarController::regSaveschool', ['filter' => 'registrar']);
$routes->get('/regDeleteschool/(:any)', 'RegistrarController::regDeleteschool/$1', ['filter' => 'registrar']);
$routes->get('/regEditschool/(:any)', 'RegistrarController::regEditschool/$1', ['filter' => 'registrar']);
$routes->get('/regadmissions', 'RegistrarController::regadmissions', ['filter' => 'registrar']);
$routes->post('/regSaveadmissions', 'RegistrarController::regSaveadmissions', ['filter' => 'registrar']);
$routes->get('/regDeleteadmissions/(:any)', 'RegistrarController::regDeleteadmissions/$1', ['filter' => 'registrar']);
$routes->get('/regEditadmissions/(:any)', 'RegistrarController::regEditadmissions/$1', ['filter' => 'registrar']);

//DAC
$routes->get('/DAC', 'DACController::DAC', ['filter' => 'DAC']);

//IAC
$routes->get('/IAC', 'IACController::IAC', ['filter' => 'IAC']);

//SAC
$routes->get('/SAC', 'SACController::SAC', ['filter' => 'SAC']);

//AAC
$routes->get('/AAC', 'AACController::AAC', ['filter' => 'AAC']);
