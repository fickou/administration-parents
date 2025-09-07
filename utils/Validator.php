<?php
namespace Scolarite\Utils;

class Validator
{
    private $errors = [];

    /**
     * Vérifie si un champ est vide
     */
    public function required(string $field, $value): void
    {
        if (empty(trim($value))) {
            $this->errors[$field][] = "Le champ $field est obligatoire.";
        }
    }

    /**
     * Vérifie si la valeur est un email valide
     */
    public function email(string $field, $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Le champ $field doit être une adresse email valide.";
        }
    }

    /**
     * Vérifie la longueur minimale
     */
    public function minLength(string $field, $value, int $length): void
    {
        if (strlen($value) < $length) {
            $this->errors[$field][] = "Le champ $field doit contenir au moins $length caractères.";
        }
    }

    /**
     * Vérifie la longueur maximale
     */
    public function maxLength(string $field, $value, int $length): void
    {
        if (strlen($value) > $length) {
            $this->errors[$field][] = "Le champ $field ne doit pas dépasser $length caractères.";
        }
    }

    /**
     * Retourne les erreurs
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Vérifie s'il y a des erreurs
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
?>