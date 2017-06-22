<?xml version="1.0" encoding="ISO-8859-1" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!--

<article>
    <categorie>hi-fi</categorie>
    <titre>Recepteur BT</titre>
    <marque>ugreen</marque>
    <fournisseur>amazon</fournisseur>
    <prix>15</prix>
    <livraison unite="jours">3</livraison>
</article>
-->

<!--

! ! !<xsl:value-of select="@NO"/></h2>!
! !Film: <xsl:value-of select="FILM/TITRE"/>!
! !de <xsl:value-of select="FILM/AUTEUR"/>!
! !<ol> <xsl:for-each select="SEANCES/SEANCE">!
! ! !<li><xsl:value-of select="."/></li>!
! ! !</xsl:for-each>!
-->


<xsl:template match="articles">
    <html><body>
    <table border="1">
        <tr>
            <th>categorie</th>
            <th>titre</th>
            <th>marque</th>
            <th>fournisseur</th>
            <th>prix</th>
            <th>livraison</th>
        </tr>
    <xsl:for-each select="article">
        <tr>
            <td>
                <xsl:if test="(position() mod 2) = 0">
                    <font color="FF0000">
                    <xsl:value-of select="categorie"/>
                    </font>
                </xsl:if>

                <xsl:if test="(position() mod 2) != 0">
                    <xsl:value-of select="categorie"/>
                </xsl:if>
            </td>

            <td>
                <xsl:if test="(position() mod 2) = 0">
                    <font color="FF0000">
                        <xsl:value-of select="titre"/>
                    </font>
                </xsl:if>

                <xsl:if test="(position() mod 2) != 0">
                    <xsl:value-of select="titre"/>
                </xsl:if>
            </td>

            <td>
                <xsl:if test="(position() mod 2) = 0">
                    <font color="FF0000">
                        <xsl:value-of select="marque"/>
                    </font>
                </xsl:if>

                <xsl:if test="(position() mod 2) != 0">
                    <xsl:value-of select="marque"/>
                </xsl:if>
            </td>

            <td>
                <xsl:if test="(position() mod 2) = 0">
                    <font color="FF0000">
                        <xsl:value-of select="fournisseur"/>
                    </font>
                </xsl:if>

                <xsl:if test="(position() mod 2) != 0">
                    <xsl:value-of select="fournisseur"/>
                </xsl:if>
            </td>


            <td>
                <xsl:if test="(position() mod 2) = 0">
                    <font color="FF0000">
                        <xsl:value-of select="prix"/>
                    </font>
                </xsl:if>

                <xsl:if test="(position() mod 2) != 0">
                    <xsl:value-of select="prix"/>
                </xsl:if>
            </td>


            <td>
                <xsl:if test="(position() mod 2) = 0">
                    <font color="FF0000">
                        <xsl:value-of select="livraison"/>
                    </font>
                </xsl:if>

                <xsl:if test="(position() mod 2) != 0">
                    <xsl:value-of select="livraison"/>
                </xsl:if>
            </td>


            </tr>
    </xsl:for-each>
    </table>
    </body></html>
</xsl:template>


</xsl:stylesheet>
