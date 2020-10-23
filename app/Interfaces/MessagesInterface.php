<?php

namespace App\Interfaces;

interface MessagesInterface
{

    public function getPaginated();

    public function store($request);

    public function findById($id);

    public function update($request, $id);

    public function destroy($id);
}
