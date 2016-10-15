<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create and register new repository';

    /**
     * Тип генерируемого класса.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Replace the class name for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $this->call('make:repository-contract', [
            'name' => $this->getContractName()
        ]);

        //Добавление неймспейса для интерфейса
        $stub = str_replace('DummyInterfaceNamespace', $this->getContractNamespace() . '\\' .$this->getContractName(), $stub);

        //Добавление интерфейса
        $stub = str_replace('DummyInterface', $this->getContractName(), $stub);

        //Добавление использования модели
        $stub = str_replace('DummyModelNamespace', $this->getModelNamespace(), $stub);

        //Добавление класса модели в конструктор
        $stub = str_replace('DummyModel', $this->getModelName(), $stub);
        
        //Добавление переменной модели в конструкторе
        $stub = str_replace('DummyVariable', $this->getModelVariableName(), $stub);

        //сохранение в биндингов в конфиг файл для последующей подгрузки
        $this->saveBindings();

        return parent::replaceClass($stub, $name);
    }

    /**
     * Получить имя модели для репозитория.
     *
     * @return mixed
     */
    protected function getModelName()
    {
        return str_replace('Repository', '', $this->getNameInput());
    }

    /**
     * Получить namespace для модели.
     *
     * @return string
     */
    protected function getModelNamespace()
    {
        return 'App\Models\\' . $this->getModelName();
    }

    /**
     * Получить имя переменной для модели.
     *
     * @return string
     */
    protected function getModelVariableName()
    {
        return strtolower($this->getModelName());
    }


    /**
     * Получить имя интерфейса для замены.
     *
     * @return string
     */
    protected function getContractName()
    {
        return $this->getNameInput() . 'Contract';
    }

    /**
     * Получить неймспейс для репозитория.
     *
     * @return string
     */
    protected function getRepositoryNamespace()
    {
        return $this->getDefaultNamespace('App');
    }

    /**
     * Получить неймспейс для интерфейса репозитория.
     *
     * @return string
     */
    protected function getContractNamespace()
    {
        return $this->getRepositoryNamespace() . '\Contracts';
    }

    /**
     * Сохранить bindings в файл.
     */
    protected function saveBindings()
    {
        $config = config('repositories');

        $config[$this->getContractNamespace() . '\\' . $this->getContractName()] = $this->getRepositoryNamespace() . '\\' . $this->getNameInput();

        file_put_contents(base_path('config/repositories.php'), $this->makeConfigFileContent($config));
    }

    /**
     * Получить строку для записи в файл.
     *
     * @param array $config
     * @return string
     */
    protected function makeConfigFileContent(array $config)
    {
        $content = '<?php ' . PHP_EOL . PHP_EOL . 'return [' . PHP_EOL;

        foreach ($config as $key => $value) {
            $content .= "\t" . "'" . $key . "'  => '" . $value . "'," . PHP_EOL;
        }

        $content .= '];';

        return $content;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/repository.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }
    
}
