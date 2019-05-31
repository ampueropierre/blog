<?php
namespace App\Datetime;

/**
 * Classe DateTimeFrench
 * Extension de la classe DateTime pour afficher les jours et mois en francais
 */
class DateTimeFrench extends \DateTime {

	/**
	 * Modifie la function format de DateTime pour remplacer les mois et jours en francais 
	 * @param  string $format Récupère la date
	 * @return string la date
	 */
    public function format($format) {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, parent::format($format)));
    }
}
