<?php
interface IUserRepository {
    public function save(UserModel $user);
    public function findByEmail($email);
    public function find($id);
}