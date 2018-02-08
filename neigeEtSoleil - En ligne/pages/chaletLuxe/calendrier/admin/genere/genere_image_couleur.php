<?php
// chemin vers le fichier  config.inc.php paramètrews de connection à la base de données*************
     require("secure_genere.php");
     
//inclusion fichier liste des couleurs *********************
//  include("calendrier_liste_couleur.php");
//  include("parametres_calendrier.php");
  
// fonctions création image rectangle ou triangle********************************
function creation_image_triangle_rectangle ( $dim_x,$dim_y, $coul_fond, $coul_triangle1,  $coul_triangle2, $chemin_enregistre) {

  //correction hauteur et largeur pour meilleur aspect 
  $dim_x  = $dim_x * 5 ;
  $dim_y  = $dim_y * 5 ;

  //création de l'image********************
  $image = imagecreate($dim_x,$dim_y);

  //création des points des triangles *****************
  $points_triangle1 = array(0,0,($dim_x-0),0,0,($dim_y+0));
  $points_triangle2 = array(($dim_x-0),0,0,($dim_y+0),($dim_x-0),($dim_y+0));
  $couleur_fond   = imageColorAllocate($image,hexdec(substr($coul_fond, 1, 2)),hexdec(substr($coul_fond, 3, 2)), hexdec(substr($coul_fond, 5, 2)) );

  $col_triangle1 = imageColorAllocate($image,hexdec(substr($coul_triangle1, 1, 2)),hexdec(substr($coul_triangle1, 3, 2)), hexdec(substr($coul_triangle1, 5, 2)) );
  $col_triangle2 = imageColorAllocate($image,hexdec(substr($coul_triangle2, 1, 2)),hexdec(substr($coul_triangle2, 3, 2)), hexdec(substr($coul_triangle2, 5, 2)) );
  ImageFilledPolygon ($image, $points_triangle1, 3, $col_triangle1);
  ImageFilledPolygon ($image, $points_triangle2, 3, $col_triangle2);

  //enregistrement de l'image ************
  imagejpeg($image, $chemin_enregistre);
}

function creation_image_triangle_rectangle_cgt_client ( $dim_x,$dim_y, $coul_fond, $coul_triangle1,  $coul_triangle2, $chemin_enregistre) {

  //correction hauteur et largeur pour meilleur aspect 
  $dim_x  = $dim_x * 5 ;
  $dim_y  = $dim_y * 5 ;

  //création de l'image********************
  $image = imagecreate($dim_x,$dim_y);

  //création des points des triangles *****************
  $points_triangle1 = array(0,0,($dim_x-0),0,0,($dim_y+0));
  $points_triangle2 = array(($dim_x-0),0,0,($dim_y+0),($dim_x-0),($dim_y+0));
  $points_plogone	= array(($dim_x-0.1),0,0,($dim_y-0.1),0,$dim_y,0.1,$dim_y,$dim_x,0.1,$dim_x,0);
  $couleur_fond   	= imageColorAllocate($image,hexdec(substr($coul_fond, 1, 2)),hexdec(substr($coul_fond, 3, 2)), hexdec(substr($coul_fond, 5, 2)) );

  $col_triangle1 = imageColorAllocate($image,hexdec(substr($coul_triangle1, 1, 2)),hexdec(substr($coul_triangle1, 3, 2)), hexdec(substr($coul_triangle1, 5, 2)) );
  $col_triangle2 = imageColorAllocate($image,hexdec(substr($coul_triangle2, 1, 2)),hexdec(substr($coul_triangle2, 3, 2)), hexdec(substr($coul_triangle2, 5, 2)) );
  ImageFilledPolygon ($image, $points_triangle1, 3, $col_triangle1);
  ImageFilledPolygon ($image, $points_triangle2, 3, $col_triangle2);
  ImageFilledPolygon ($image, $points_plogone, 6, $couleur_fond);

  //enregistrement de l'image ************
  imagejpeg($image, $chemin_enregistre);
}

function creation_image_double_rectangle ( $dim_x,$dim_y, $coul_fond, $coul_rectangle1,  $coul_rectangle2, $chemin_enregistre) {

  //correction hauteur et largeur pour meilleur aspect
  $dim_x  = $dim_x * 5 ;
  $dim_y  = $dim_y * 5 ;

  //création de l'image********************
  $image = imagecreate($dim_x,$dim_y);

  //création des points des triangles *****************
  $points_rectangle1 = array(0,0,($dim_x-1),0,($dim_x-1),($dim_y/2),0 ,($dim_y/2));
  $points_rectangle2 = array(0,($dim_y/2),($dim_x-1),($dim_y/2),($dim_x-1),($dim_y-1), 0,($dim_y-1) );
  $couleur_fond   = imageColorAllocate($image,hexdec(substr($coul_fond, 1, 2)),hexdec(substr($coul_fond, 3, 2)), hexdec(substr($coul_fond, 5, 2)) );

  $col_rectangle1 = imageColorAllocate($image,hexdec(substr($coul_rectangle1, 1, 2)),hexdec(substr($coul_rectangle1, 3, 2)), hexdec(substr($coul_rectangle1, 5, 2)) );
  $col_rectangle2 = imageColorAllocate($image,hexdec(substr($coul_rectangle2, 1, 2)),hexdec(substr($coul_rectangle2, 3, 2)), hexdec(substr($coul_rectangle2, 5, 2)) );
  ImageFilledPolygon ($image, $points_rectangle1, 4, $col_rectangle1);
  ImageFilledPolygon ($image, $points_rectangle2, 4, $col_rectangle2);

  //enregistrement de l'image ************
  imagejpeg($image, $chemin_enregistre);
}




//dimensions image *****************************************
 $temp = explode ("px",$hauteur_mini_cellule_date );
 $hauteur_img_fd = $temp[0] ;
 $largeur_img_fd = $largeur_mini_cellule_date ;

//création image de fond jour "libre" **********************
creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre, $couleur_libre, $couleur_libre, "img_cal/libre.jpg");
creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$couleur_jour_week_end, $couleur_jour_week_end, $couleur_jour_week_end, "img_cal/weekend.jpg");

// création des images**************************************

  $nb_result = count ($couleur_reserve);
  if ( $nb_result > 0 ) {
  foreach ($couleur_reserve as $cle => $val_couleur_reserve )  {
      //création des images fond couleur en cours et unie******************************
      creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_reserve, $val_couleur_reserve, $val_couleur_reserve, "img_cal/".$cle.".jpg");
      //création des images couleur actuelle montante et descendant**************
         foreach ($couleur_reserve as $cle_triangle => $val_couleur_triangle )  {
               creation_image_triangle_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_triangle,$val_couleur_triangle, $val_couleur_reserve, "img_cal/triangle_".$cle_triangle."-".$cle.".jpg");
               @chmod ("img_cal/triangle_".$cle_triangle."-".$cle.".jpg",0644);
               creation_image_triangle_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_reserve,$val_couleur_reserve, $val_couleur_triangle, "img_cal/triangle_".$cle."-".$cle_triangle.".jpg");
               @chmod ("img_cal/triangle_".$cle."-".$cle_triangle.".jpg",0644);
			   creation_image_triangle_rectangle_cgt_client ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$val_couleur_triangle, $val_couleur_reserve, "img_cal/triangle_".$cle_triangle."-".$cle."_cgt_client.jpg");
               @chmod ("img_cal/triangle_".$cle_triangle."-".$cle.".jpg",0644);
               creation_image_triangle_rectangle_cgt_client ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$val_couleur_reserve, $val_couleur_triangle, "img_cal/triangle_".$cle."-".$cle_triangle."_cgt_client.jpg");
               @chmod ("img_cal/triangle_".$cle."-".$cle_triangle.".jpg",0644);
               creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_triangle,$val_couleur_triangle, $val_couleur_reserve, "img_cal/rectangle_".$cle_triangle."-".$cle.".jpg");
               @chmod ("img_cal/rectangle_".$cle_triangle."-".$cle.".jpg",0644);
               creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_reserve,$val_couleur_reserve, $val_couleur_triangle, "img_cal/rectangle_".$cle."-".$cle_triangle.".jpg");
               @chmod ("img_cal/rectangle_".$cle."-".$cle_triangle.".jpg",0644);
         }

      //création des images couleur libre et montante **************
      creation_image_triangle_rectangle ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$couleur_libre, $val_couleur_reserve, "img_cal/triangle_libre-".$cle.".jpg");
      @chmod ("img_cal/triangle_libre-".$cle.".jpg",0644);
      creation_image_triangle_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_reserve,$val_couleur_reserve, $couleur_libre, "img_cal/triangle_".$cle."-libre.jpg");
      @chmod ("img_cal/triangle_".$cle."-libre.jpg",0644);
	  creation_image_triangle_rectangle_cgt_client ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$couleur_libre, $val_couleur_reserve, "img_cal/triangle_libre-".$cle."_cgt_client.jpg");
      @chmod ("img_cal/triangle_libre-".$cle.".jpg",0644);
      creation_image_triangle_rectangle_cgt_client ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$val_couleur_reserve, $couleur_libre, "img_cal/triangle_".$cle."-libre_cgt_client.jpg");
      @chmod ("img_cal/triangle_".$cle."-libre.jpg",0644);
      creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$couleur_libre, $val_couleur_reserve, "img_cal/rectangle_libre-".$cle.".jpg");
      @chmod ("img_cal/rectangle_libre-".$cle.".jpg",0644);
      creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_reserve,$val_couleur_reserve, $couleur_libre, "img_cal/rectangle_".$cle."-libre.jpg");
      @chmod ("img_cal/rectangle_".$cle."-libre.jpg",0644);

      creation_image_triangle_rectangle ( $largeur_img_fd,$hauteur_img_fd,$couleur_jour_week_end,$couleur_jour_week_end, $val_couleur_reserve, "img_cal/triangle_weekend-".$cle.".jpg");
      @chmod ("img_cal/triangle_weekend-".$cle.".jpg",0644);
      creation_image_triangle_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_reserve,$val_couleur_reserve, $couleur_jour_week_end, "img_cal/triangle_".$cle."-weekend.jpg");
      @chmod ("img_cal/triangle_".$cle."-weekend.jpg",0644);
	  creation_image_triangle_rectangle_cgt_client ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$couleur_jour_week_end, $val_couleur_reserve, "img_cal/triangle_weekend-".$cle."_cgt_client.jpg");
      @chmod ("img_cal/triangle_weekend-".$cle.".jpg",0644);
      creation_image_triangle_rectangle_cgt_client ( $largeur_img_fd,$hauteur_img_fd,$couleur_libre,$val_couleur_reserve, $couleur_jour_week_end, "img_cal/triangle_".$cle."-weekend_cgt_client.jpg");
      @chmod ("img_cal/triangle_".$cle."-weekend.jpg",0644);
      creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$couleur_jour_week_end,$couleur_jour_week_end, $val_couleur_reserve, "img_cal/rectangle_weekend-".$cle.".jpg");
      @chmod ("img_cal/rectangle_weekend-".$cle.".jpg",0644);
      creation_image_double_rectangle ( $largeur_img_fd,$hauteur_img_fd,$val_couleur_reserve,$val_couleur_reserve, $couleur_jour_week_end, "img_cal/rectangle_".$cle."-weekend.jpg");
      @chmod ("img_cal/rectangle_".$cle."-weekend.jpg",0644);
     }
  }



?>