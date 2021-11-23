# Affichez tous les champs de la table thearticle
SELECT * FROM thearticle;

# Affichez tous les champs de la table thearticle_has_thesection
SELECT * FROM thearticle_has_thesection;

# Affichez tous les champs de la table theright
SELECT * FROM theright;

# Affichez tous les champs de la table thesection
SELECT * FROM thesection;

# Affichez tous les champs de la table theuser
SELECT * FROM theuser;

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser
SELECT thearticle.*, theuser.theuserName, theuser.theuserLogin
	FROM thearticle
    INNER JOIN theuser
		ON thearticle.theuser_idtheuser = theuser.idtheuser;

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection (2 lignes de résultats)
SELECT thearticle.*, thesection.idthesection, thesection.thesectionTitle
FROM thearticle
	LEFT JOIN thearticle_has_thesection
		ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
    LEFT JOIN thesection
		ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection
        ;

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"
SELECT thearticle.*, GROUP_CONCAT(thesection.idthesection) AS idthesection, 
					GROUP_CONCAT(thesection.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle
	LEFT JOIN thearticle_has_thesection
		ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
    LEFT JOIN thesection
		ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection
    GROUP BY thearticle.idthearticle    ;

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser et
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"
SELECT thearticle.*, 
	   theuser.theuserName, theuser.theuserLogin,	
					GROUP_CONCAT(thesection.idthesection) AS idthesection, 
					GROUP_CONCAT(thesection.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle
	INNER JOIN theuser
		ON thearticle.theuser_idtheuser = theuser.idtheuser 
	LEFT JOIN thearticle_has_thesection
		ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
    LEFT JOIN thesection
		ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection
        
    GROUP BY thearticle.idthearticle    ;

SELECT a.idthearticle, a.thearticleTitle, LEFT(a.thearticleText,250) AS thearticleText, a.thearticleDate,
u.theuserName, u.theuserLogin, u.idtheuser,
GROUP_CONCAT(s.idthesection ORDER BY a.thearticledate DESC) AS idthesection, 
GROUP_CONCAT(s.thesectionTitle ORDER BY a.thearticledate DESC SEPARATOR '|||' ) AS thesectionTitle
FROM thearticle a
INNER JOIN theuser u
ON a.theuser_idtheuser = u.idtheuser 
LEFT JOIN thearticle_has_thesection a_s
ON a.idthearticle = a_s.thearticle_idthearticle
LEFT JOIN thesection s
ON a_s.thesection_idthesection = s.idthesection
WHERE a.thearticleStatus = 1
GROUP BY a.idthearticle;