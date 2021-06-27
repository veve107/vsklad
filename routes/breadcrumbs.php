<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail){
    $trail->push('Home', route('admin.home'));
});

Breadcrumbs::for('dashboard', function ($trail){
    $trail->parent('home');
    $trail->push('Dashboard', route('admin.home'));
});
Breadcrumbs::for('users', function ($trail){
    $trail->parent('home');
    $trail->push('Používatelia', route('users'));
});
Breadcrumbs::for('profile', function ($trail, $user){
    $trail->parent('home');
    $trail->push('Profil používateľa ' . $user->name, route('user.profile', $user->id));
});
Breadcrumbs::for('editProfile', function ($trail, $user){
    $trail->parent('profile', $user);
    $trail->push('Editácia používateľa' . $user->name, route('user.edit', $user->id));
});
Breadcrumbs::for('positions', function ($trail){
    $trail->parent('home');
    $trail->push('Pozície', route('users.positions'));
});
Breadcrumbs::for('departments', function ($trail){
    $trail->parent('home');
    $trail->push('Oddelenia', route('users.departments'));
});
Breadcrumbs::for('addRequest', function ($trail){
    $trail->parent('home');
    $trail->push('Žiadosť o techniku', route('request.add'));
});
Breadcrumbs::for('requests', function ($trail){
    $trail->parent('home');
    $trail->push('Zoznam žiadostí', route('request.index'));
});
Breadcrumbs::for('detailRequest', function ($trail, $request){
    $trail->parent('requests');
    $trail->push('Detail žiadosti číslo ' . $request->id , route('request.detail', $request->id));
});
Breadcrumbs::for('processRequest', function ($trail, $request){
    $trail->parent('requests');
    $trail->push('Spracovanie žiadosti číslo ' . $request->id , route('request.process', $request->id));
});
Breadcrumbs::for('hardware', function ($trail){
    $trail->parent('home');
    $trail->push('Zoznam zariadení', route('hardware'));
});
Breadcrumbs::for('addHardware', function ($trail){
    $trail->parent('hardware');
    $trail->push('Pridanie zariadenia', route('hardware.add'));
});
Breadcrumbs::for('types', function ($trail){
    $trail->parent('home');
    $trail->push('Typy', route('hardware.types'));
});
Breadcrumbs::for('orders', function ($trail){
    $trail->parent('home');
    $trail->push('Objednávky', route('hardware.orders'));
});
Breadcrumbs::for('brands', function ($trail){
    $trail->parent('home');
    $trail->push('Značky', route('hardware.brands'));
});
