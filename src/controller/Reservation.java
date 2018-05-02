package controller;

public class Reservation 
{
	private int idResa, idLogement;
	private double montant;
	private boolean payee;
	private String descriptResa;
	
	public Reservation()
	{
		this.idResa = 0;
		this.idLogement = 0;
		this.montant = 0;
		this.payee = false;
		this.descriptResa = "";
	}
	
	public Reservation(int idResa, int idLogement, double montant, boolean payee,
			String descriptResa)
	{
		this.idResa = 0;
		this.idLogement = 0;
		this.montant = 0;
		this.payee = false;
		this.descriptResa = descriptResa;
	}
	
	public Reservation(int idLogement, double montant, boolean payee,
			String descriptResa)
	{
		this.idResa = 0;
		this.idLogement = 0;
		this.montant = 0;
		this.payee = false;
		this.descriptResa = descriptResa;
	}

	public int getIdResa() {
		return idResa;
	}

	public void setIdResa(int idResa) {
		this.idResa = idResa;
	}

	public int getIdLogement() {
		return idLogement;
	}

	public void setIdLogement(int idLogement) {
		this.idLogement = idLogement;
	}

	public double getMontant() {
		return montant;
	}

	public void setMontant(double montant) {
		this.montant = montant;
	}

	public boolean isPayee() {
		return payee;
	}

	public void setPayee(boolean payee) {
		this.payee = payee;
	}

	public String getDescriptResa() {
		return descriptResa;
	}

	public void setDescriptResa(String descriptResa) {
		this.descriptResa = descriptResa;
	}	
}