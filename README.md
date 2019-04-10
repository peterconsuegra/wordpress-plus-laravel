# WordPressPlusLaravel



#Install
pasos resumen

copiar Middleware
protected $table = 'wp_users';
crear campo remember_token en wp_users
cambiar user_registered a predetemrinado null en wp_users
error de metodo repetido en WordPress __
agregar 'auth.wp' => \App\Http\Middleware\WPAuthMiddleware::class, en kernel.php
setear base de datos de laravel la misma de WordPress

```


## Licence

This package is under MIT License
