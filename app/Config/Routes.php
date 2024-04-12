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
$routes->get('/learner', 'EnrollmentController::learner', ['filter' => 'student']);
$routes->get('/address', 'EnrollmentController::address', ['filter' => 'student']);
$routes->get('/admission', 'EnrollmentController::admission', ['filter' => 'student']);
$routes->get('/family', 'EnrollmentController::family', ['filter' => 'student']);
$routes->get('/sibling', 'EnrollmentController::sibling', ['filter' => 'student']);
$routes->get('/school', 'EnrollmentController::school', ['filter' => 'student']);
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

//REGISTRAR MAIL
$routes->get('/email', 'RegistrarController::mail', ['filter' => 'registrar']);

//REGISTRAR ACADEMIC INFO
$routes->get('/sections', 'RegistrarController::sections', ['filter' => 'registrar']);
$routes->post('/saveSection', 'RegistrarController::saveSection', ['filter' => 'registrar']);
$routes->get('/deleteSection/(:any)', 'RegistrarController::deleteSection/$1', ['filter' => 'registrar']);
$routes->get('/editSection/(:any)', 'RegistrarController::editSection/$1', ['filter' => 'registrar']);
$routes->get('/subjects', 'RegistrarController::subjects', ['filter' => 'registrar']);
$routes->post('/saveSubject', 'RegistrarController::saveSubject', ['filter' => 'registrar']);
$routes->get('/deleteSubject/(:any)', 'RegistrarController::deleteSubject/$1', ['filter' => 'registrar']);
$routes->get('/editSubject/(:any)', 'RegistrarController::editSubject/$1', ['filter' => 'registrar']);

//REGISTRAR ALUMNI
$routes->get('/alumni', 'RegistrarController::alumni', ['filter' => 'registrar']);
$routes->post('/saveAlumni', 'RegistrarController::saveAlumni', ['filter' => 'registrar']);
$routes->get('/deleteAlumni/(:any)', 'RegistrarController::deleteAlumni/$1', ['filter' => 'registrar']);
$routes->get('/editAlumni/(:any)', 'RegistrarController::editAlumni/$1', ['filter' => 'registrar']);

//DAC
$routes->get('/DAC', 'DACController::DAC', ['filter' => 'DAC']);

//IAC
$routes->get('/IAC', 'IACController::IAC', ['filter' => 'IAC']);

//SAC
$routes->get('/SAC', 'SACController::SAC', ['filter' => 'SAC']);

//AAC
$routes->get('/AAC', 'AACController::AAC', ['filter' => 'AAC']);
