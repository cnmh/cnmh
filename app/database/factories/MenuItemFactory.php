<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\MenuGroup;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $menuGroup = MenuGroup::first();
        if (!$menuGroup) {
            $menuGroup = MenuGroup::factory()->create();
        }

        return [
            'nom' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'description' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'icon' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'visible_for' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'menu_group_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
