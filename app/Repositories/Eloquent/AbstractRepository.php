<?php

namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{
    protected mixed $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function query ()
    {
        return $this->model->query();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }


    public function all()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update(array $data)
    {
        return $this->model->update($data);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
