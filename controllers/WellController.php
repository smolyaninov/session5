<?php

/**
 * Class WellController
 * Контроллер для работы с моделью Wells
 */
class WellController
{
    /**
     * GET /wells/$ID
     * Получения всего списка или по идентификатору
     * @param null $id
     * @return bool
     */
    public function actionGet($id = null): bool
    {
        if (isset($id)) {
            $data = Wells::getById($id);
            if (isset($data['ID'])) {
                $return = [
                    'status' => 'ok',
                    'data' => $data
                ];
                http_response_code(200);
            } else {
                $return = [
                    'status' => 'error',
                    'message' => 'not found'
                ];
                http_response_code(404);
            }
        } else {
            $data = Wells::get();
            $return = [
                'status' => 'ok',
                'data' => $data
            ];
            http_response_code(200);
        }
        return print json_encode($return);
    }

    /**
     * POST /wells
     * Добавление
     * @return int
     */
    public function actionAdd(): int
    {
        if ((isset($_POST['WellTypeID'])) and (isset($_POST['WellName'])) and (isset($_POST['GasOilDepth'])) and (isset($_POST['Capacity']))) {
            $data = [
                'WellTypeID' => (int)$_POST['WellTypeID'],
                'WellName' => $_POST['WellName'],
                'GasOilDepth' => (int)$_POST['GasOilDepth'],
                'Capacity' => (int)$_POST['Capacity'],
            ];
            $id = Wells::add($data);
            $return = [
                'status' => 'ok',
                'data' => Wells::getById($id)
            ];
            http_response_code(201);
        } else {
            $return = [
                'status' => 'error',
                'message' => 'invalid params'
            ];
            http_response_code(400);
        }
        return print json_encode($return);
    }

    /**
     * PUT /wells/$ID
     * Обновление
     * @param $id
     * @return int
     */
    public function actionUpdate($id): int
    {
        if ($_SERVER['REQUEST_METHOD'] == Router::PUT) {
            $data = json_decode(file_get_contents("php://input"));
            $data = [
                'ID' => $id,
                'WellTypeID' => (int)$data->WellTypeID,
                'WellName' => $data->WellName,
                'GasOilDepth' => (int)$data->GasOilDepth,
                'Capacity' => (int)$data->Capacity,
            ];
            $result = Wells::update($data);
            if ($result == 'ok') {
                $return = [
                    'status' => 'ok',
                    'data' => Wells::getById($data['ID'])
                ];
                http_response_code(200);
            } else {
                $return = [
                    'status' => 'error',
                    'message' => $result
                ];
                http_response_code(400);
            }
        } else {
            $return = [
                'status' => 'error',
                'message' => 'invalid params'
            ];
            http_response_code(400);
        }
        return print json_encode($return);
    }

    /**
     * DELETE /wells/$ID
     * Удаление
     * @param $id
     * @return int
     */
    public function actionDelete($id): int
    {
        if ($_SERVER['REQUEST_METHOD'] == Router::DELETE) {
            if (Wells::check($id)) {
                $result = Wells::delete($id);
                if ($result == 'ok') {
                    $return = [
                        'status' => 'ok',
                        'data' => 'Запись удалена'
                    ];
                    http_response_code(200);
                } else {
                    $return = [
                        'status' => 'error',
                        'message' => $result
                    ];
                    http_response_code(400);
                }
            } else {
                $return = [
                    'status' => 'error',
                    'message' => 'not found'
                ];
                http_response_code(400);
            }
        } else {
            $return = [
                'status' => 'error',
                'message' => 'invalid params'
            ];
            http_response_code(400);
        }
        return print json_encode($return);
    }
}