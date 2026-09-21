<?php
require_once __DIR__ . "/DataBase.php";
class Validation
{
    private array $data;
//    ex:[
//         "email" =>"Ab123@gmail.com",
//         "password" => "123456789"
//     ]
    private array $rules;
    // ex:[
    //     'email' =>['required','email'],
    //     'password'=> ['required',['min',8]]
    // ]
    private array $errors = [];
    // ex:[
    //     'email' =>[
    //         'email is required',
    //         'email must be vail email',
    //     ],
    //     'password' => [
    //         'password is required'
    //     ]
    // ]
    public function __construct(array $data, array $rules)
    {
        $this->data=$data;
        $this->rules = $rules;
    }

    public function validate(): array
    {
        foreach ($this->rules as $field => $rules) {

            $value = $this->data[$field] ?? null;

            foreach ($rules as $rule) {

                if (is_string($rule)) {

                    if ($rule === 'required') {
                        $this->validateRequired($field, $value);
                    }elseif ($rule === 'email') {
                        $this->validateEmail($field, $value);
                    } elseif ($rule === 'egPhone') {
                        $this->validatePhone($field, $value);
                    }
                } elseif (is_array($rule)) {

                    if ($rule[0] === 'min') {
                        $this->validateMin(
                            $field,
                            $value,
                            $rule[1]
                        );
                    } elseif ($rule[0] === 'unique') {
                        $this->validateUnique(
                            $field,
                            $value,
                            $rule[1]
                        );
                    } elseif ($rule[0] === 'exists') {
                        $this->validateExists(
                            $field,
                            $value,
                            $rule[1],
                            $rule[2]
                        );
                    }
                }
            }
        }

        return $this->errors;
    }
    private function validateRequired(string $field, mixed $value){
        if($value == null || trim( (string) $value) === ""){
            $this ->addError($field,"{$field} is required");
        }
    }
    private function validateEmail(string $field, mixed $value):void
    {
        if(empty($value)){
            return;
        }

        $regex = "/^[A-Za-z_][A-Za-z_0-9.-]+@(gmail|yahoo)\.(com|org)$/";
        if(!preg_match($regex,$value)){
            $this -> addError($field,"{$field} must be valid");
        }
    }

    private function addError(string $field,string $msg):void{
        $this ->errors[$field][]=$msg;
    }

    private function validateMin(string $field, mixed $value,int $min = 8):void{
        if(empty($value)){
            return;
        }
        if(strlen($value) < $min){
            $this -> addError($field,"{$field} must be at least {$min} charters" );
        }
    }

    private function validateUnique(string $field, mixed $value, string $tableName){
        $DB = Database::getConnection();
        $stmt = $DB -> query("SELECT * FROM {$tableName} WHERE {$field} = '{$value}';");
        $result = $stmt -> fetchAll();
        if(!empty($result)){
            $this -> addError($field,"this {$field} is exists");
        }
    }

    private function validateExists(string $field, mixed $value, string $tableName,string $columnName)
    {
        $DB = Database::getConnection();
        $stmt = $DB->query("SELECT * FROM {$tableName} WHERE {$columnName} = '{$value}';");
        $result = $stmt->fetchAll();
        if (empty($result)) {
            $this->addError($field, "this {$field} is not exists");
        }
    }

    private function validatePhone(string $field, mixed $value)
    {
        if ($field === 'Phone' && trim((string)$value) != "") {
            $pattern = "/^01[0125][0-9]{8}$/";
            if (!preg_match($pattern, $value)) {
                $this->addError($field, " {$field} Must Be In EGY Form");
            }
        }
    }
}                                                  