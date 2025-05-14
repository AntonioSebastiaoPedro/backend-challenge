<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateEntity extends Command
{
    protected $signature = 'generate:entity {name}';
    protected $description = 'Generate Model, Controller, Repository, DTOs, and Resource for a given entity';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $this->info("Gerating entity: $name");

        $this->generateModel($name);
        $this->generateService($name);
        $this->generateController($name);
        $this->generateRepository($name);
        $this->generateDTOs($name, 'Create');
        $this->generateDTOs($name, 'Edit');
        $this->generateRequests($name, 'Store');
        $this->generateRequests($name, 'Update');
        $this->generateResource($name);
    }

    private function generateModel($name)
    {
        $path = app_path('Models');
        $fileName = $path . "/{$name}.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("Model $name already exists.");
            return;
        }

        $modelStub = File::get(base_path('stubs/model.stub'));
        $modelContent = str_replace('{{class}}', $name, $modelStub);
        File::put($fileName, $modelContent);
        $this->info("Model $name created!");
    }

    private function generateController($name)
    {
        $path = app_path('Http/Controllers');
        $fileName = $path . "/{$name}Controller.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("{$name}Controller already exists.");
            return;
        }

        $controllerStub = File::get(base_path('stubs/controller.stub'));
        $controllerContent = str_replace('{{class}}', $name, $controllerStub);
        File::put($fileName, $controllerContent);
        $this->info("{$name}Controller created!");
    }

    private function generateRepository($name)
    {
        $path = app_path('Repositories');
        $fileName = $path . "/{$name}Repository.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("{$name}Repository already exists.");
            return;
        }

        $repositoryStub = File::get(base_path('stubs/repository.stub'));
        $repositoryContent = str_replace('{{class}}', $name, $repositoryStub);
        File::put($fileName, $repositoryContent);
        $this->info("{$name}Repository already exists!");
    }

    private function generateDTOs($name, $type)
    {
        $path = app_path("DTOs/{$name}");
        $fileName = $path . "/{$type}{$name}DTO.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("{$type}{$name}DTO already exists.");
            return;
        }

        $dtoStub = File::get(base_path('stubs/dto.stub'));
        $dtoContent = str_replace(['{{class}}', '{{type}}'], [$name, $type], $dtoStub);
        File::put($fileName, $dtoContent);
        $this->info("{$type}{$name}DTO already exists!");
    }

    private function generateRequests($name, $type)
    {
        $path = app_path("Http/Requests/{$name}");
        $fileName = $path . "/{$type}{$name}Request.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("{$type}{$name}Request already exists.");
            return;
        }

        $requestStub = File::get(base_path('stubs/request.stub'));
        $requestContent = str_replace(['{{class}}', '{{type}}'], [$name, $type], $requestStub);
        File::put($fileName, $requestContent);
        $this->info("{$type}{$name}Request already exists!");
    }

    private function generateResource($name)
    {
        $path = app_path("Http/Resources");
        $fileName = $path . "/{$name}Resource.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("{$name}Resource already exists.");
            return;
        }

        $resourceStub = File::get(base_path('stubs/resource.stub'));
        $resourceContent = str_replace('{{class}}', $name, $resourceStub);
        File::put($fileName, $resourceContent);
        $this->info("{$name}Resource already exists!");
    }

    private function generateService($name)
    {
        $path = app_path("Services");
        $fileName = $path . "/{$name}Service.php";

        if (!File::exists($path)) {
            File::makeDirectory($path,0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("{$name}Service already exists.");
            return ;
        }

        $serviceStub = File::get(base_path("stubs/service.stub"));
        $serviceContent = str_replace("{{class}}", $name, $serviceStub);
        File::put($fileName, $serviceContent);
        $this->info("{$name}Resource already exists!");
    }
}
