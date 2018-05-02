package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

import modele.Modele;

public class VueConnexion extends JFrame implements ActionListener, KeyListener
{
	private JPanel unPanel = new JPanel();
	private JButton btAnnuler = new JButton("Annuler");
	private JButton btSeConnecter = new JButton("Se Connecter");
	
	private JTextField txtLogin = new JTextField();
	private JPasswordField txtMdp = new JPasswordField();
	
	public VueConnexion()
	{
		this.setTitle("Gestion des locations");
		this.setResizable(false);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setLayout(null);
		this.setBounds(200, 200, 600, 400);
		this.getContentPane().setBackground(Color.gray);
		
		//Construction du panel
		this.unPanel.setBounds(50, 200, 500, 150);
		this.unPanel.setBackground(Color.cyan);
		this.unPanel.setLayout(new GridLayout(3,2));
		this.unPanel.add(new JLabel("Login : "));
		this.unPanel.add(txtLogin);
		this.unPanel.add(new JLabel("MDP : "));
		this.unPanel.add(txtMdp);
		this.unPanel.add(btAnnuler);
		this.unPanel.add(btSeConnecter);
		
		//Ajouter le panel dans la fenetre
		this.add(this.unPanel);
		
		//Ajout de l'image logo dans la fenetre
		ImageIcon logo = new ImageIcon("src/images/logo.jpg");
		JLabel lbLogo = new JLabel(logo);
		lbLogo.setBounds(50, 20, 500, 150);
		this.add(lbLogo);
		
		//rendre les boutons cliquables
		this.btAnnuler.addActionListener(this);
		this.btSeConnecter.addActionListener(this);
		this.txtLogin.addKeyListener(this);
		this.txtMdp.addKeyListener(this);
		
		this.setVisible(true);
	}
	
	@Override
	public void actionPerformed(ActionEvent e) 
	{
		if(e.getSource() == btAnnuler)
		{
			this.txtLogin.setText("");
			this.txtMdp.setText("");
		}
		else if (e.getSource() == btSeConnecter)
		{
			traitement();
		}
	}
	
	public void traitement()
	{
		String login = this.txtLogin.getText();
		String mdp = new String (this.txtMdp.getPassword());
		
		//Verification des identifiants dans la bdd
		String droits = Modele.verifConnexion(login, mdp);
		if (droits.equals(""))
		{
			JOptionPane.showMessageDialog(this, "Veuiller vérifier vos identifiants");
		}
		else
		{
			JOptionPane.showMessageDialog(this, "Bienvenue!\n Vos droits sont :"+ droits);
		}
	}

	@Override
	public void keyPressed(KeyEvent e) 
	{
		if(e.getKeyChar() == KeyEvent.VK_ENTER)
		{
			traitement();
		}
	}

	@Override
	public void keyReleased(KeyEvent e) 
	{
		
	}

	@Override
	public void keyTyped(KeyEvent e) 
	{
		
	}	
}