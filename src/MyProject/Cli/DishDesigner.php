<?php

namespace MyProject\Cli;

use MyProject\Services\Db;

class DishDesigner extends AbstractCommand
{
    public function execute(): void
    {
        $ingredientCodes = $this->getParam();
        $ingredientArray = str_split($ingredientCodes);
        $ingredients = [];
        foreach ($ingredientArray as $ingredientCode) {
            $ingredients[] = $this->getIngredientsByCode($ingredientCode);
        }

        $combinations = [];
        $this->generateCombinations($ingredients, 0, [], $combinations);

        $result = [];
        foreach ($combinations as $combination) {
            $price = 0;
            $productData = [];

            foreach ($combination as $ingredient) {
                $price += $ingredient->price;
                $productData[] = [
                    'type' => $ingredient->type,
                    'value' => $ingredient->title,
                ];
            }

            $result[] = [
                'products' => $productData,
                'price' => $price,
            ];
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    private function getIngredientsByCode(string $code): array
    {
        $db = Db::getInstance();
        $ingredients = $db->query("SELECT i.title, it.title AS type, i.price FROM ingredient AS i INNER JOIN ingredient_type AS it ON i.type_id = it.id WHERE it.code = ?", [$code]);

        return $ingredients;
    }

    private function generateCombinations(array $ingredients, int $currentIndex = 0, array $currentCombination = [], array &$combinations): void
    {
        if ($currentIndex >= count($ingredients)) {
            $combinations[] = $currentCombination;
            return;
        }

        for ($i = 0; $i < count($ingredients[$currentIndex]); $i++) {
            // Проверяем, что текущий ингредиент уже не включен в комбинацию
            if (!in_array($ingredients[$currentIndex][$i], $currentCombination)) {
                $newCombination = $currentCombination;
                $newCombination[] = $ingredients[$currentIndex][$i];
                $this->generateCombinations($ingredients, $currentIndex + 1, $newCombination, $combinations);
            }
        }
    }
}
