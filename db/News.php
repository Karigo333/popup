<?php

class News
{


    public $news;


    public function __construct($arr = NULL)
    {
        if ($arr == NULL) {
            $query = DB::query()->query('SELECT * FROM test_task.news');
            $this->news = $query->fetchAll();
        } else {
            $this->news = [];
            $query = 'SELECT * FROM test_task.news WHERE id=:id';
            foreach ($arr as $key => $value)
                if (is_int($key)) {
                    $query_p = DB::query()->prepare($query);
                    $query_p->bindValue(':id', $value);
                    $query_p->execute();
                    $this->news[] = $query_p->fetch();
                }
        }
    }


    public function add($heading, $description, $image , $data)
    {
        $query = "INSERT INTO test_task.news (heading, description, image, data) VALUES (:heading,  :description,  :image,  :data)";
        $query_r = DB::query()->prepare($query);
        $query_r->bindValue(':heading', $heading);
        $query_r->bindValue(':description', $description);
        $query_r->bindValue(':image', $image);
        $query_r->bindValue(':data', $data);
        $query_r->execute();
        header('Location: index.php');
    }


    public function delete($id)
    {
        $query = "DELETE FROM test_task.news WHERE id = :id";
        $query_p = DB::query()->prepare($query);
        $query_p->bindValue(':id', $id);
        $query_p->execute();
    }

    public function update(array $params): bool
    {
        $sql = "UPDATE test_task.news SET heading = :heading, description= :description, image = :image, data = :data WHERE id = :id";
        $stmt = DB::query()->prepare($sql);
        $stmt->bindParam(':id', $params['id']);
        $stmt->bindParam(':heading', $params['heading']);
        $stmt->bindParam(':description', $params['description']);
        $stmt->bindParam(':image', $params['image']);
        $stmt->bindParam(':data', $params['data']);
        return $stmt->execute();
    }

    public function getById(string $id)
    {
        $sql = "select * from test_task.news where id = :id";
        $sth = DB::query()->prepare($sql);
        $sth->bindParam(':id', $id);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }



    public function get(int $limit, int $offset)
    {

        $offset *= $limit;
        $query = "SELECT * FROM test_task.news order by sort_date desc LIMIT $limit offset $offset";
        $query_r = DB::query()->prepare($query);
        $query_r->execute();

        return $query_r->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function getCount()
    {
        $query = "SELECT COUNT(*) AS count FROM test_task.news";
        $sth = DB::query()->prepare($query);
        $sth->execute();
        return $sth->fetch(\PDO::FETCH_ASSOC)['count'];

    }

    public function search($str)
    {
        $arr = [];
        $query = 'SELECT heading FROM test_task.news';
        $sth = DB::query()->prepare($query);
        $sth->execute();
        $sth->fetch(\PDO::FETCH_ASSOC);
        foreach ($sth as $value) {
            $s = stristr($value['heading'], $str);
            if ($s !== false) {
                $arr[] = $value;
            }
        }
        return $arr;
    }

}