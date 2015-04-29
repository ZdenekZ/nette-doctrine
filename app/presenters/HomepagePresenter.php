<?php

namespace App\Presenters;

use App\Article;
use App\Blog;
use Kdyby\Doctrine\EntityManager;
use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	/** @var  EntityManager @inject */
	public $em;

	public function renderDefault()
	{
		$articleRepository = $this->em->getRepository(Article::class);
		$articles = $articleRepository->createQueryBuilder('a')
			->leftJoin('a.blog', 'b')
			->addSelect('b')
//			->where('b.id = ?1')
//			->setParameter(1, 2)
			->getQuery()->getResult()
		;
//		$articles = $articleRepository->findAll();
		$this->template->articles = $articles;
	}

	/**
	 * @param int $blogID
	 * @param $name
	 */
	public function actionCreateArticle($blogID, $name)
	{
		$blogsRepo = $this->em->getRepository(Blog::class);
		$blog = $blogsRepo->find($blogID);
		$article = new Article($blog, $name, 'asdkfhaksdhkhrtk');
		$this->em->persist($article);
		$this->em->flush();
		$this->redirect('default');
	}


	/**
	 * @param $name
     */
	public function actionCreateBlog($name)
	{
		$blog = new Blog($name);
		$this->em->persist($blog);
		$this->em->flush();
		$this->redirect('default');
	}

}
