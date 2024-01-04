  2023_11_23_125934_create_permission_tables ............................................................................................. 10ms FAIL

   Illuminate\Database\QueryException 

  SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes (Connection: mysql, SQL: alter table `permissions` add unique `permissions_name_guard_name_unique`(`name`, `guard_name`))

  at vendor/laravel/framework/src/Illuminate/Database/Connection.php:822
    818▕                     $this->getName(), $query, $this->prepareBindings($bindings), $e
    819▕                 );
    820▕             }
    821▕ 
  ➜ 822▕             throw new QueryException(
    823▕                 $this->getName(), $query, $this->prepareBindings($bindings), $e
    824▕             );
    825▕         }
    826▕     }

      +9 vendor frames 

  10  database/migrations/2023_11_23_125934_create_permission_tables.php:27
      Illuminate\Support\Facades\Facade::__callStatic()
      +24 vendor frames 

  35  artisan:35
      Illuminate\Foundation\Console\Kernel::handle()