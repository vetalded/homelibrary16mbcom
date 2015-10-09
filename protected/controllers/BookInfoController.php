<?php
class BookInfoController extends SiteController
{
	
	public function actionAbout($id){
        $book=Books::model()->findByPk($id);
        if(!empty($book)){
            $comments=BooksComments::model()->findAll(array('condition'=>'book_id = :bookId','params'=>array(':bookId'=>$book->id),'order'=>'id DESC','limit'=>'10'));

            $this->render('about',array('book'=>$book,'comments'=>$comments));
        }else{
            $this->redirect(array('index/index'));
        }
    }
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest){
				echo $error['message'];
			}
			else{
				$this->render('error', $error);
			}
		}
	}
    public function actionCreateComment(){
        if(isset($_POST['id'],$_POST['comment'])){
            $id=$_POST['id'];
            $comment=$_POST['comment'];
            $model=new BooksComments();
            $model->book_id=$id;
            $model->comment=$comment;
            $model->user_id=Yii::app()->user->id;
            $model->date=date('Y-m-d H:i:s');
            $model->rate=0;
            if($model->save()){
                $this->renderPartial('_comment',array('comment'=>$model));
            }
        }
    }
    public function actionCreateCommentToComment(){
        if(isset($_POST['comment_id'],$_POST['comment'])){
            $comment_id=$_POST['comment_id'];
            $comment=$_POST['comment'];
            $model=new BooksCommentToComment();
            $model->books_comment_id=$comment_id;
            $model->comment=$comment;
            $model->user_id=Yii::app()->user->id;
            $model->date=date('Y-m-d H:i:s');
            $model->rate=0;
            if($model->save()){
                $this->renderPartial('_commentToComment',array('comment'=>$model));
            }
        }
    }

    public function actionSetCommentLike($comment_id,$val){
        /*
     * @var BooksComments $comment
     * */
        $result=array();
        $comment=BooksComments::model()->findByPk($comment_id);
        $result['status']=CommentLike::setCommentLike($comment_id,$val);
        $result['like']=$comment->getLike();
        $result['dislike']=$comment->getLike('-');
        echo json_encode($result);
    }
    public function actionSetCommentToCommentLike($comment_id,$val){
        /*
     * @var BooksCommentToComment $comment
     * */
        $result=array();
        $comment=BooksCommentToComment::model()->findByPk($comment_id);
        $result['status']=CommentToCommentLike::setCommentLike($comment_id,$val);
        $result['like']=$comment->getLike();
        $result['dislike']=$comment->getLike('-');
        echo json_encode($result);
    }
    public function actionLoadComments($book_id,$offset){
        $comments=BooksComments::model()->findAll(array('condition'=>'book_id = :bookId','order'=>'id DESC','offset'=>intval($offset),'limit'=>'10','params'=>array(':bookId'=>$book_id)));
        foreach($comments as $comment){
            $this->renderPartial('_comment',array('comment'=>$comment));
        }
    }
    public function actionSetRate($rate,$id){
        echo BookRate::setBookRate($id,$rate);
    }
}