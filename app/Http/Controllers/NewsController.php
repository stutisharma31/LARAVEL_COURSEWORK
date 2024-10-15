<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
class NewsController extends Controller
{
    private $newsArticles = [
        'technology' => [
            ['id' => 1, 'title' => 'Tech News 1', 'content' => 'Content of Tech News 1'],
            ['id' => 2, 'title' => 'Tech News 2', 'content' => 'Content of Tech News 2'],
        ],
        'sports' => [
            ['id' => 1, 'title' => 'Sports News 1', 'content' => 'Content of Sports News 1'],
            ['id' => 2, 'title' => 'Sports News 2', 'content' => 'Content of Sports News 2'],
        ],
    ];
    public function displayAllNews()
    {
        return response()->json($this->newsArticles);
    }
    public function displayByCategory($category)
    {
        if (isset($this->newsArticles[$category])) {
            return response()->json($this->newsArticles[$category]);
        }
        return response()->json(['error' => 'Category not found'], 404);
    }
    public function displayByCategoryAndId($category, $id)
    {
        if (isset($this->newsArticles[$category])) {
            foreach ($this->newsArticles[$category] as $article) {
                if ($article['id'] == $id) {
                    return response()->json($article);
                }
            }
            return response()->json(['error' => 'Article not found'], 404);
        }
        return response()->json(['error' => 'Category not found'], 404);
    }
}
