<?php

class User extends Model {                  
    protected static $tableName = 'users'; //copia do modelo, passa a tabela users e
    protected static $columns = [           //joga o conteudo no array de colunas
        'id', 
        'name', 		
        'password', 			
        'email', 		
        'start_date', 		
        'end_date',	
        'is_admin',	
    ];

    public static function getActiveUsersCount() {
        return static::getCount(['raw' => 'end_date IS NULL']);
    }

    public function insert() {
        $this->validate();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if(!$this->end_date) $this->end_date = null;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::insert();
    }

    public function update() {
        $this->validate();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if(!$this->end_date) $this->end_date = null;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::update();
    }

    private function validate(){
        $errors = [];

        if(!$this->name){
            $errors['name'] = 'Nome é um compo obrigatório.';
        }

        if(!$this->email){
            $errors['email'] = 'Email é um compo obrigatório.';
        }elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email inválido.';
        }

        if(!$this->start_date){
            $errors['start_date'] = 'Data de admissão é um compo obrigatório.';
        }elseif(!DateTime::createFromFormat('Y-m-d', $this->start_date)) {
            $errors['start_date'] = 'Data de admissão de seguir o padrão dd/mm/aaaa.';
        }

        if($this->end_date && !DateTime::createFromFormat('Y-m-d', $this->end_date)){
            $errors['end_date'] = 'Data de desligamento deve seguir o padrão dd/mm/aaaa.';
        }

        if(!$this->password){
            $errors['password'] = 'Senha é um compo obrigatório.';
        }

        if(!$this->confirm_password){
            $errors['confirm_password'] = 'Confirmação de senha é um compo obrigatório.';
        }

        if($this->password && $this->confirm_password
            && $this->password !== $this->confirm_password){
                //$errors['password'] = 'As senhas não são iguais.';
                $errors['confirm_password'] = 'As senhas não são iguais.';
            }

        if(count($errors) > 0){
            throw new ValidationException($errors);
            
        }
    }
}