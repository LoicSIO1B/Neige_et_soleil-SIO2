package controller;

public class Lieu 
{
	private int idLieu;
	private double prixMin, prixMax;
	String descriptionLieu;
	
	public Lieu()
	{
		this.idLieu = 0;
		this.prixMin = 0;
		this.prixMax = 0;
		this.descriptionLieu = "";
		
	}
	
	public Lieu(int idLieu, double prixMin, double prixMax, String descriptionLieu)
	{
		this.idLieu = 0;
		this.prixMin = 0;
		this.prixMax = 0;
		this.descriptionLieu = descriptionLieu;
		
	}
	
	public Lieu(double prixMin, double prixMax, String descriptionLieu)
	{
		this.idLieu = 0;
		this.prixMin = 0;
		this.prixMax = 0;
		this.descriptionLieu = descriptionLieu;
	}

	public int getIdLieu() {
		return idLieu;
	}

	public void setIdLieu(int idLieu) {
		this.idLieu = idLieu;
	}

	public double getPrixMin() {
		return prixMin;
	}

	public void setPrixMin(double prixMin) {
		this.prixMin = prixMin;
	}

	public double getPrixMax() {
		return prixMax;
	}

	public void setPrixMax(double prixMax) {
		this.prixMax = prixMax;
	}

	public String getDescriptionLieu() {
		return descriptionLieu;
	}

	public void setDescriptionLieu(String descriptionLieu) {
		this.descriptionLieu = descriptionLieu;
	}
}