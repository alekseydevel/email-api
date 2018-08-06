<?php
namespace App\Repository;

use App\Models\Theme;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThemeRepository
{
    /**
     * @param int $id
     * @throws NotFoundHttpException
     * @return Theme
     */
    public function findById(int $id)
    {
        return new Theme(['id' => $id, 'body' => 'theme body']); // hard code for not using Eloquent, blabla
//        return Theme::find($id);
    }
}
