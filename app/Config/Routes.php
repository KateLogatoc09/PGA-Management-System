<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test', 'Home::Test');
//$routes->get('/admins', 'AdminController::admin');

$routes->get('/login', 'Home::logreg', ['filter' => 'loggedin']);

$routes->get('/reg', 'Home::reg', ['filter' => 'loggedin']);
$routes->get('/about', 'Home::ab');
$routes->get('/verify', 'Home::verify', ['filter' => 'loggedin']);
$routes->get('/verifying', 'Home::verifying', ['filter' => 'loggedin']);
$routes->get('/forget', 'Home::forget');

$routes->get('/admins', 'AdminController::index', ['filter' => 'admin']);
$routes->get('/alumni', 'AdminController::alumni', ['filter' => 'admin']);
$routes->get('/adminstudent', 'AdminController::adminstudent', ['filter' => 'admin']);
$routes->get('/adminstudinfo', 'AdminController::adminstudinfo', ['filter' => 'admin']);
$routes->post('/adminfamily', 'AdminController::adminfamily', ['filter' => 'admin']);
$routes->post('/adminaddress', 'AdminController::adminaddress', ['filter' => 'admin']);
$routes->post('/saveAlumni', 'AdminController::saveAlumni', ['filter' => 'admin']);
$routes->post('/saveLearner', 'AdminController::saveLearner', ['filter' => 'admin']);
$routes->post('/adminadmissions', 'AdminController::adminadmissions', ['filter' => 'admin']);
$routes->post('/saveAccount', 'AdminController::saveAccount', ['filter' => 'admin']);
$routes->get('/deleteAccount/(:any)', 'AdminController::deleteAccount/$1', ['filter' => 'admin']);
$routes->get('/editAccount/(:any)', 'AdminController::editAccount/$1', ['filter' => 'admin']);
$routes->get('/deleteAlumni/(:any)', 'AdminController::deleteAlumni/$1', ['filter' => 'admin']);
$routes->get('/editAlumni/(:any)', 'AdminController::editAlumni/$1', ['filter' => 'admin']);
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

$routes->get('/addTeacher', 'AdminController::addTeacher', ['filter' => 'admin']);
$routes->get('/teach/(:any)', 'AdminController::teach/$1', ['filter' => 'admin']);
$routes->post('/saveteacher', 'AdminController::save', ['filter' => 'admin']);
$routes->get('/deleteteacher/(:any)', 'AdminController::delete/$1', ['filter' => 'admin']);
$routes->get('/editteacher/(:any)', 'AdminController::edit/$1', ['filter' => 'admin']);
$routes->get('/teacher', 'TeacherController::teacher', ['filter' => 'teacher']);
$routes->get('/enroll', 'AdminController::enroll', ['filter' => 'admin']);
$routes->get('/deleteenroll/(:any)', 'AdminController::delete/$1', ['filter' => 'admin']);
$routes->get('/editenroll/(:any)', 'AdminController::edit/$1', ['filter' => 'admin']);

$routes->get('/graph', 'GradeController::index', ['filter' => 'student']);

$routes->get('/student', 'StudentController::index', ['filter' => 'student']);


$routes->get('/addenroll', 'EnrollmentController::addenroll', ['filter' => 'student']);
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

$routes->get('/li', 'LibraryController::index', ['filter' => 'librarian']);
$routes->post('/saveBook', 'LibraryController::saveBook', ['filter' => 'librarian']);
$routes->post('/saveBorrowedBook', 'LibraryController::saveBorrowedBook', ['filter' => 'librarian']);
$routes->post('/borrowBook', 'LibraryController::borrowBook', ['filter' => 'librarian']);
$routes->get('/librarian', 'LibraryController::librarian', ['filter' => 'librarian']);
$routes->get('/deleteBorrow/(:any)', 'LibraryController::deleteBorrow/$1', ['filter' => 'librarian']);
$routes->get('/editBorrow/(:any)', 'LibraryController::editBorrow/$1', ['filter' => 'librarian']);
$routes->get('/deleteBook/(:any)', 'LibraryController::deleteBook/$1', ['filter' => 'librarian']);
$routes->get('/editBook/(:any)', 'LibraryController::editBook/$1', ['filter' => 'librarian']);
