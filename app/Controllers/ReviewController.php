<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use CodeIgniter\RESTful\ResourceController;

class ReviewController extends BaseController
{
    protected $format = 'json';

    public function index($produk_id)
    {
        $model = new ReviewModel();
        $reviews = $model->asArray()->where('id_produk', $produk_id)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $tree = $this->buildTree($reviews);
        return $this->response->setJSON($tree);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        $model = new ReviewModel();
        $item = [
            'id_produk' => $data['id_produk'],
            'id_users' => session('user_id') ?? 1, // sementara default
            'id_parent' => $data['id_parent'] ?? null,
            'rating' => $data['rating'] ?? null,
            'komentar' => $data['komentar'],
        ];
        $model->insert($item);
        $item['id_review'] = $model->getInsertID();
        return $this->response->setJSON($item);
    }

    private function buildTree(array $elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $e) {
            if ($e['id_parent'] == $parentId) {
                $children = $this->buildTree($elements, $e['id']);
                if ($children) {
                    $e['replies'] = $children;
                } else {
                    $e['replies'] = [];
                }
                $e['user'] = session('nama'); // bisa ambil dari tabel user jika perlu
                $branch[] = $e;
            }
        }
        return $branch;
    }
}
