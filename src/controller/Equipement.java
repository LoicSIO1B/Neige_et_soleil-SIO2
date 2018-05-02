package controller;

public class Equipement 
{
	private int IDEquip;
	private String nomEquip, descripEquip;
	private double tarif;
	
	public Equipement()
	{
		this.IDEquip = 0;
		this.nomEquip = "";
		this.descripEquip = "";
		this.tarif = 0;
	}
	
	public Equipement(int IDEquip, String nomEquip, String descripEquip, double tarif)
	{
		this.IDEquip = 0;
		this.nomEquip = nomEquip;
		this.descripEquip = descripEquip;
		this.tarif = 0;
	}
	
	public Equipement(String nomEquip, String descripEquip, double tarif)
	{
		this.IDEquip = 0;
		this.nomEquip = nomEquip;
		this.descripEquip = descripEquip;
		this.tarif = 0;
	}

	public int getIDEquip() {
		return IDEquip;
	}

	public void setIDEquip(int iDEquip) {
		IDEquip = iDEquip;
	}

	public String getNomEquip() {
		return nomEquip;
	}

	public void setNomEquip(String nomEquip) {
		this.nomEquip = nomEquip;
	}

	public String getDescripEquip() {
		return descripEquip;
	}

	public void setDescripEquip(String descripEquip) {
		this.descripEquip = descripEquip;
	}

	public double getTarif() {
		return tarif;
	}

	public void setTarif(double tarif) {
		this.tarif = tarif;
	}
}