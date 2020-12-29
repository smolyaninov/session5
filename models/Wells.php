<?php

/**
 * Class Wells
 * Класс для работы с таблицей Wells
 */
class Wells
{
    /**
     * Получение всех записей
     * @return array
     */
    public static function get(): array
    {
        $dbh = Database::getDb();
        $sth = $dbh->prepare("SELECT * FROM `wells`");
        try {
            $sth->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получение записи по ID
     * @param $id
     * @return mixed
     */
    public static function getById($id)
    {
        $dbh = Database::getDb();
        $sth = $dbh->prepare("SELECT * FROM `wells` where ID =:id");
        try {
            $sth->execute(['id' => $id]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Добавление записи
     * @param $data
     * @return string
     */
    public static function add($data)
    {
        $dbh = Database::getDb();
        $sth = $dbh->prepare("INSERT INTO `wells` SET `WellTypeID` = :WellTypeID, `WellName` = :WellName, `GasOilDepth` = :GasOilDepth, `Capacity` = :Capacity");
        try {
            $sth->execute([
                'WellTypeID' => $data['WellTypeID'],
                'WellName' => $data['WellName'],
                'GasOilDepth' => $data['GasOilDepth'],
                'Capacity' => $data['Capacity']
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $dbh->lastInsertId();
    }

    /**
     * Обновление записи
     * @param $data
     * @return string
     */
    public static function update($data)
    {
        $dbh = Database::getDb();
        $sth = $dbh->prepare("UPDATE `wells` SET `WellTypeID` = :WellTypeID, `WellName` = :WellName, `GasOilDepth` = :GasOilDepth, `Capacity` = :Capacity WHERE `ID` = :ID");
        try {
            $sth->execute([
                'ID' => $data['ID'],
                'WellTypeID' => $data['WellTypeID'],
                'WellName' => $data['WellName'],
                'GasOilDepth' => $data['GasOilDepth'],
                'Capacity' => $data['Capacity']
            ]);
            return 'ok';
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Удаление записи
     * @param $id
     * @return string
     */
    public static function delete($id): string
    {
        $dbh = Database::getDb();
        $sth = $dbh->prepare("DELETE FROM `wells` WHERE `ID` = :ID");
        try {
            $sth->execute([
                'ID' => $id,
            ]);
            return 'ok';
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Проверка наличие записи в БД
     * @param $id
     * @return bool
     */
    public static function check($id): bool
    {
        $dbh = Database::getDb();
        $sth = $dbh->prepare("SELECT * FROM `wells` where ID =:id");
        try {
            $sth->execute(['id' => $id]);
            $data = $sth->fetch(PDO::FETCH_ASSOC);
            if (isset($data['ID'])){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}