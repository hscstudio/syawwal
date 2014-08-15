<?php

namespace backend\modules\sekretariat\organisation\controllers;

use Yii;
use backend\models\Employee;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{

		public $layout = '@hscstudio/heart/views/layouts/column2';
	 
	
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Employee::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $currentFiles=[];
                $currentFiles[0]=$model->photo;
                            $currentFiles[1]=$model->document1;
                            $currentFiles[2]=$model->document2;
                    
        if ($model->load(Yii::$app->request->post())) {
            $files=[];
								
				$files[0] = \yii\web\UploadedFile::getInstance($model, 'photo');
				$model->photo=isset($currentFiles[0])?$currentFiles[0]:'';
				if(!empty($files[0])){
					$ext = end((explode(".", $files[0]->name)));
					$model->photo = uniqid() . '.' . $ext;
					$path = '';
					if(isset(Yii::$app->params['uploadPath'])){
						$path = Yii::$app->params['uploadPath'].'/employee/'.$model->id.'/';
					}
					else{
						$path = Yii::getAlias('@common').'/../files/employee/'.$model->id.'/';
					}
					@mkdir($path, 0777, true);
					@chmod($path, 0777);
					$paths[0] = $path . $model->photo;
					if(isset($currentFiles[0])) @unlink($path . $currentFiles[0]);
				}
											
				$files[1] = \yii\web\UploadedFile::getInstance($model, 'document1');
				$model->document1=isset($currentFiles[1])?$currentFiles[1]:'';
				if(!empty($files[1])){
					$ext = end((explode(".", $files[1]->name)));
					$model->document1 = uniqid() . '.' . $ext;
					$path = '';
					if(isset(Yii::$app->params['uploadPath'])){
						$path = Yii::$app->params['uploadPath'].'/employee/'.$model->id.'/';
					}
					else{
						$path = Yii::getAlias('@common').'/../files/employee/'.$model->id.'/';
					}
					@mkdir($path, 0777, true);
					@chmod($path, 0777);
					$paths[1] = $path . $model->document1;
					if(isset($currentFiles[1])) @unlink($path . $currentFiles[1]);
				}
											
				$files[2] = \yii\web\UploadedFile::getInstance($model, 'document2');
				$model->document2=isset($currentFiles[2])?$currentFiles[2]:'';
				if(!empty($files[2])){
					$ext = end((explode(".", $files[2]->name)));
					$model->document2 = uniqid() . '.' . $ext;
					$path = '';
					if(isset(Yii::$app->params['uploadPath'])){
						$path = Yii::$app->params['uploadPath'].'/employee/'.$model->id.'/';
					}
					else{
						$path = Yii::getAlias('@common').'/../files/employee/'.$model->id.'/';
					}
					@mkdir($path, 0777, true);
					@chmod($path, 0777);
					$paths[2] = $path . $model->document2;
					if(isset($currentFiles[2])) @unlink($path . $currentFiles[2]);
				}
						
            if($model->save()){
				$idx=0;
                foreach($files as $file){
					if(isset($paths[$idx])){
						$file->saveAs($paths[$idx]);
					}
					$idx++;
				}
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // error in saving model
            }            
        }
		else{
			//return $this->render(['update', 'id' => $model->id]);
			return $this->render('update', [
                'model' => $model,
            ]);
		}
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {
		$model = new Employee; // your model can be loaded here
		// Check if there is an Editable ajax request
		if (isset($_POST['hasEditable'])) {
			// read your posted model attributes
			if ($model->load($_POST)) {
				// read or convert your posted information
				$model2 = $this->findModel($_POST['editableKey']);
				$name=key($_POST['Employee'][$_POST['editableIndex']]);
				$value=$_POST['Employee'][$_POST['editableIndex']][$name];
				$model2->$name = $value ;
				$model2->save();
				// return JSON encoded output in the below format
				echo \yii\helpers\Json::encode(['output'=>$value, 'message'=>'']);
				// alternatively you can return a validation error
				// echo \yii\helpers\Json::encode(['output'=>'', 'message'=>'Validation error']);
			}
			// else if nothing to do always return an empty JSON encoded output
			else {
				echo \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
			}
		return;
		}
		// Else return to rendering a normal view
		return $this->render('view', ['model'=>$model]);
	}

    public function actionExporExcel()
    {
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load('../../../files/templates/template.honor.transport.diklat.xlsx');
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
        $objPHPExcel->getProperties()->setTitle("Honor Transport Diklat");

        $qryPejabat="SELECT * FROM `tb_reference` 
        LEFT JOIN tb_admin ON tb_admin.id_admin = tb_reference.value_reference
        WHERE code_reference IN ('pejabat_pembuat_komitmen','bendahara_pengeluaran')";
        $exePejabat = $mysqli->query($qryPejabat);
        while($showPejabat=$exePejabat->fetch_array()){
            if($showPejabat['code_reference']=='pejabat_pembuat_komitmen'){
                $name_ppk=$showPejabat['name_admin'];   
                $nip_ppk=$showPejabat['nip_admin']; 
            } 
            if($showPejabat['code_reference']=='bendahara_pengeluaran'){
                $name_bp=$showPejabat['name_admin'];    
                $nip_bp=$showPejabat['nip_admin'];  
            } 
        }

        $tgl_surat = normalizedate($_POST['tgl_surat'],0);

        $objPHPExcel->getActiveSheet()->setCellValue('E3', $_POST['pembayaran'])
        ->setCellValue('F5', $_POST['no_surat'])
        ->setCellValue('F6', date("j",strtotime($tgl_surat))." ".$months[date("n",strtotime($tgl_surat))-1]." ".date("Y",strtotime($tgl_surat))."")
        ->setCellValue('K17', "Jakarta, .... ".$months[date("n")-1]." ".date("Y")."")
        ->setCellValue('K19', @$_SESSION['myadmin-admin']['name_admin'])
        ->setCellValue('K20', "NIP ".@$_SESSION['myadmin-admin']['nip_admin'])
        ->setCellValue('H19', $_POST['name_admin'])
        ->setCellValue('H20', "NIP ".$_POST['nip_admin'])
        ->setCellValue('D19', $name_ppk)
        ->setCellValue('D20', "NIP ".$nip_ppk)
        ->setCellValue('B19', $name_bp)
        ->setCellValue('B20', "NIP ".$nip_bp);      

        $qryHonor="SELECT * FROM `tb_reference` WHERE code_reference LIKE '%honor%'";
        $exeHonor = $mysqli->query($qryHonor);
        $honor_transport_dalam_kota=110000;
        while($showHonor=$exeHonor->fetch_array()){
            if($showHonor['code_reference']=='honor_transport_dalam_kota') $honor_transport_dalam_kota=$showHonor['value_reference'];
        }

        $data = array();
        if(isset($_POST['admin'])){
            $admins=@$_POST['admin'];
            $admin = implode(",", $admins);
            $freks=@$_POST['frek'];
            $qry2="SELECT * FROM tb_admin 
            LEFT JOIN tb_level ON tb_admin.id_level=tb_level.id_level 
            WHERE id_admin in (".$admin.") 
            ORDER BY tb_admin.id_level, id_admin"; 
            //die($qry2);
            $rResult2 = $mysqli->query($qry2);
            $idx=0;
            $baseRow = 12;
            $total_frek=0;
            $total_jumlah_kotor=0;
            $total_pajak=0;
            $total_jumlah_bersih=0;
            while ( $aRow2 = $rResult2->fetch_array() ){        
                $row = $baseRow + $idx;
                if($idx>0) $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
                $data[$idx]['no']=$idx+1;
                $data[$idx]['name_admin']=$aRow2["name_admin"];
                $data[$idx]['nip_admin']=$aRow2["nip_admin"];
                $data[$idx]['position_admin']=$aRow2["position_admin"];
                $data[$idx]['frek']=$freks[$aRow2["nip_admin"]];

                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $idx+1);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $aRow2["name_admin"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, "Pusdiklat Keuangan Umum");
                $gol="-";
                $pos = strpos($aRow2['gol_admin'], "IV");
                if ($pos == false) {
                    $pos = strpos($aRow2['gol_admin'], "III");
                    if ($pos == false) {
                        $pos = strpos($aRow2['gol_admin'], "II");
                        if ($pos == false) {
                            $gol="I";
                        }
                        else{
                            $gol="II";
                        }
                    }
                    else{
                        $gol="III";
                    }
                }
                else{
                    $gol="IV";
                }
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $gol);
                $frek=(int)$freks[$aRow2["nip_admin"]];
                $total_frek+=$frek;
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $frek);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $honor_transport_dalam_kota);
                $jumlah_kotor=$honor_transport_dalam_kota*$frek;
                $total_jumlah_kotor+=$jumlah_kotor;
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $jumlah_kotor);
                if($gol=='III') $pajak=5*$jumlah_kotor/100;
                else if($gol=='IV') $pajak=15*$jumlah_kotor/100;
                else $pajak=0;
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $pajak);
                $total_pajak+=$pajak;
                $jumlah_bersih=$jumlah_kotor-$pajak;
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $jumlah_bersih);
                $total_jumlah_bersih+=$jumlah_bersih;
                $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, "-");
                if($idx%2==0) $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, '=A'.$row.'&") ............"');
                else $objPHPExcel->getActiveSheet()->setCellValue('L'.$row, '=A'.$row.'&") ............"');
                $idx++;
            }
        }

        $row=$row+2;
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $total_frek);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $total_jumlah_kotor);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $total_pajak);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $total_jumlah_bersih);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, Trim(Terbilang($total_jumlah_bersih)).' rupiah');
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPrintArea('A1:L'.($row+7));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="honor-transport-diklat.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

        return $this->render('index');
    }
}
