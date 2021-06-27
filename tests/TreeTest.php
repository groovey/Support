<?php declare(strict_types=1);

use Pandango\Support\Tree;
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{

    /**
     * Mock all the categories
     */
    private function getCategories()
    {
        $categories = [
            ['id' => 1, 'parent_id' => null, 'slug' => 'cat-1', 'order' => 1],
            ['id' => 2, 'parent_id' => null, 'slug' => 'cat-2', 'order' => 1],
            ['id' => 3, 'parent_id' => 2, 'slug' => 'cat-2-1', 'order' => 1],
            ['id' => 4, 'parent_id' => 2, 'slug' => 'cat-2-2', 'order' => 1],
            ['id' => 5, 'parent_id' => 3, 'slug' => 'cat-2-2-1', 'order' => 1],
        ];

        return $categories;
    }

    /**
     * Match the total count of the data
     */
    public function testTotalCount()
    {
        $datas = (new Tree)->make($this->getCategories())->toNestedArray();
        $this->assertEquals(2, count($datas));
    }

    /**
     * Check if the first category item is present
     */
    public function testMatchFirstCategory()
    {
        $datas = (new Tree)->make($this->getCategories())->toNestedArray();
        $this->assertContains('cat-1', $datas['cat-1']);
    }

    /**
     * Check if the last category item is present
     */
    public function testMatchLastCategory()
    {
        $datas = (new Tree)->make($this->getCategories())->toNestedArray();
        $this->assertContains('cat-2-2-1', $datas['cat-2']['subcategories']['cat-2-1']['subcategories']['cat-2-2-1']);
    }
}