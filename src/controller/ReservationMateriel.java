package controller;

public class ReservationMateriel 
{
	private int idResaM, idEquip;
	private String dateDebutResa, dateFinResa;
	
	public ReservationMateriel()
	{
		this.idResaM = 0;
		this.idEquip = 0;
		this.dateDebutResa = "";
		this.dateFinResa = "";
	}
	
	public ReservationMateriel(int idResaM, int idEquip, String dateDebutResa,
			String dateFinResa)
	{
		this.idResaM = 0;
		this.idEquip = 0;
		this.dateDebutResa = dateDebutResa;
		this.dateFinResa = dateFinResa;
	}
	
	public ReservationMateriel(int idEquip, String dateDebutResa,
			String dateFinResa)
	{
		this.idResaM = 0;
		this.idEquip = 0;
		this.dateDebutResa = dateDebutResa;
		this.dateFinResa = dateFinResa;
	}

	public int getIdResaM() {
		return idResaM;
	}

	public void setIdResaM(int idResaM) {
		this.idResaM = idResaM;
	}

	public int getIdEquip() {
		return idEquip;
	}

	public void setIdEquip(int idEquip) {
		this.idEquip = idEquip;
	}

	public String getDateDebutResa() {
		return dateDebutResa;
	}

	public void setDateDebutResa(String dateDebutResa) {
		this.dateDebutResa = dateDebutResa;
	}

	public String getDateFinResa() {
		return dateFinResa;
	}

	public void setDateFinResa(String dateFinResa) {
		this.dateFinResa = dateFinResa;
	}
}