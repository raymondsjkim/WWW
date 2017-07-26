<?php 
require_once ("includes/php/checkCookieAgreement.php");

$username = $_COOKIE['agreement_ID'];
$password = $_COOKIE['agreement_Key'];
$hour = time() + 10800;

if (isset($_POST['submit'])) {
	$query = mysql_query("UPDATE accounts SET agreement='1' WHERE username='$username'", $linkID)
	or die(mysql_error());
	mysql_close();
	setcookie(ID_my_site, $username, $hour); 
	setcookie(Key_my_site, $password, $hour); 
	header("Location: index.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="googlebot" content="noindex, noarchive, nofollow">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<title>Alegria Dealer Agreement</title>
		<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<style type="text/css">
#tos {
	margin: auto;
	height: 400px;
	width: 800px;
	border: 1px solid #ccc;
	overflow: auto;
}
#tos p {
	padding: 5px;
	margin: 0px;
	text-align: justify;
	text-indent: 20px;	
}
#tos img {
	max-width: 800px;
	max-height: 100px;
	display: block;
	margin-left: auto;
	margin-right: auto;
}
#submitform {
	width: 300px;
	margin-left: auto;
	margin-right: auto;
}

h2{
	margin: auto;
	text-align: center;
}

</style>
	</head>

	<body>
		<div id="btt" style="position:absolute;right:10px;top:-100px;z-index:999;border:none;">
    		<div><a href="#top"><img src="images/backtotop.png" border="none"></a></div>
		</div>
		<div id="Container">
			<div id="Outer">
				<div id="Header">
					<?php include("navigation/topNav.php"); ?>
				</div>
				<div id="Wrapper">
					<div id="tos">
						<img src="images/letterhead.jpg" />
						<br /><br />
						<h2>DEALER AGREEMENT AND GENERAL BUSINESS POLICIES</h2>
						<P ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>This
						Dealer Agreement and General Business Policies (“Agreement”) is
						made and entered into by and between you (“Dealer”), on the one
						hand, and Pepper Gate Footwear, Inc., a California corporation,
						(“Company”), on the other hand (hereinafter, the “Company”
						and the “Dealer” shall collectively be known as the “Parties”).
						 </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>In
						consideration of the mutual promises below and other good and
						valuable consideration, the sufficiency of which are hereby
						acknowledged, the Parties agree as follows:</FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>1.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Definitions</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	“Product”
						or “Products” shall mean all footwear, apparel, packaging,
						display materials, merchandising materials, accessories and other
						goods ordered or purchased through the Company.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	“Company
						Marks” shall mean all trademarks, designs, patents, copyrights and
						other intellectual property owned and/or licensed by the Company or
						its affiliates, including, but not limited to, the following: 
						“Alegria by PG Lite</FONT></FONT><SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>®</FONT></FONT></SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>”
						(and associated designs for Women’s and Men’s logos), “PG Lite
						by Pepper Gate</FONT></FONT><SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>®</FONT></FONT></SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>”
						(and associated design), “SlipGuardian</FONT></FONT><SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>®</FONT></FONT></SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>”
						and “This is what Happy look like</FONT></FONT><SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>®</FONT></FONT></SUP><FONT FACE="Times New Roman, serif"><FONT SIZE=2>.”
						</FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	“Internet-based
						applications” shall mean and include the following:  (a) Websites,
						meaning all Internet websites, web pages, and/or other online means,
						including, but not limited to, third party websites, landing pages,
						video sites, aggregator and auction sites, owned, controlled or used
						by Dealer in connection with Internet sales and/or marketing of the
						Products; and (b) Social Media, meaning any Website or Internet-based
						application that uses web-based technologies to turn communication
						into interactive dialogue and/or to create and exchange
						user-generated content, including, but not limited to, social
						networking sites (e.g., Facebook, Twitter), blogs, microblogs and
						content communities.   </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>2.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Dealer
						Duties</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						shall use best efforts to promote demand for and sale of the
						Products, to maintain and properly train sufficient personnel with
						respect to the Products, maintain a place of business and adequate
						facilities for said purpose and use prudent business practices at all
						times.  Dealer agrees to maintain such place of business and display
						area satisfactory to Company.  Dealer also agrees to register and
						maintain a dealer account on the Company’s Alegria Dealer Center,
						located on the web at http://www.dealer.alegriashoes.com.  Dealer
						shall comply with all Company guidelines and policies in effect from
						time to time.  However, with respect to the Company’s Minimum
						Advertised Price (“MAP”) policy, Dealer acknowledges that said
						policy is a unilateral policy of the Company and the Parties agree
						that nothing in this Agreement shall be construed as an agreement
						between the Parties with respect to the Company MAP policy.  Dealer
						shall conduct its business in compliance with all applicable federal,
						state and local laws, rules, regulations and ordinances.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>3.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Internet
						Sales</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>In
						addition to entering into this Agreement, prior to engaging in any
						promotion, advertising or sales using Internet-based applications,
						Dealer shall first submit the Company’s “E-Commerce Application”
						document and be approved by the Company for E-Commerce Status. 
						Company reserves the right to refuse E-Commerce Status to the Dealer
						in its sole and absolute discretion.  Dealer shall refrain from
						conducting any promotion, advertising or sales of the Products prior
						to the Company’s approval and counter-execution of the E-Commerce
						Application.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>4.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Warranties</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Company may supply written warranties, specifications and
						instructions (“Provided Warranty/Warranties”) with certain
						Products.  OTHER THAN AS EXPRESSLY SET FORTH IN ANY PROVIDED
						WARRANTY, THE COMPANY MAKES NO WARRANTY, REPRESENTATION OR PROMISE,
						EITHER EXPRESS OR IMPLIED, WITH RESPECT TO SUCH PRODUCT, INCLUDING,
						BUT NOT LIMITED TO, ANY WARRANTY OF MERCHANTABILITY OR FITNESS FOR A
						PARTICULAR PURPOSE, AND ALL SUCH WARRANTIES ARE HEREBY DISCLAIMED BY
						THE COMPANY.  Correction of nonconformities will be Dealer’s
						exclusive remedy in the event of such nonconformity and will
						constitute fulfillment of all liabilities by the Company.  Dealer
						shall make no warranty, representation or promise with respect to any
						Product other than those expressly set forth in the Provided
						Warranties included with such Product.  Dealer hereby agrees to
						indemnify and hold the Company harmless from and against any and all
						claims, causes of action and/or damages arising from any warranty,
						representation and/or promise with respect to any and all Product(s)
						made by the Dealer other than those expressly set forth in any
						Provided Warranties.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>5.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Limitation
						of Liability</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>In
						no event, whether on account of Products furnished hereunder, delays
						in delivery thereof or services performed upon or with respect to
						such Products will the Company be liable for damages, whether direct,
						special, indirect, incidental or consequential, including, but not
						limited to, loss of profits or revenue, diminution of value of the
						Products, or claims of Dealer’s customers for damages, and Dealer
						hereby agrees to indemnify and hold the Company harmless from and
						against all such damages.  The Company’s liability on any claim or
						cause of action, whether sounding in contract, tort, warranty, strict
						liability or otherwise for any loss or damage arising out of,
						connected with, or resulting from this Agreement or the performance
						or breach thereof, or from the design, manufacture, sale, delivery,
						resale, repair, replacement or use of any Product covered by or
						furnished under this Agreement with Dealer shall in no event exceed
						the purchase price allocable to the Product or portion thereof which
						gives rise to the claim or cause of action.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>6.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Company’s
						Intellectual Property</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Certain
						of the Products may bear Company Marks which either belong to the
						Company or which the Company may use by permission of the owner of
						such marks.  Dealer acknowledges and agrees that the Company is the
						exclusive owner and/or licensed user of the Company Marks, that
						neither Dealer nor any third party has any right, title or interest
						in or to the Company Marks, that Dealer shall at no time claim any
						right, title or interest in the Company Marks and that Dealer shall
						at no time infringe upon, contest or challenge any Company Marks.  If
						at any time Dealer acquires any goodwill or reputation in the Company
						Marks, then immediately upon the Company’s request, Dealer agrees,
						without separate payment or other consideration, to take all actions
						necessary to assign and transfer any such right to the Company, and
						Dealer does hereby assign and transfer any such right to the Company.
						 Dealer shall not use the Company Marks in a disparaging manner or in
						any manner which could mislead the public, nor shall Dealer place any
						goods or likenesses of any goods other than the Products in proximity
						to any Company Marks, whether in advertising (print or Internet) or
						in Dealer’s physical business location(s).  Neither Dealer, nor any
						third party associated with Dealer, may use any Company Marks in any
						manner other than in connection with the solicitation of sales,
						promotion and/or advertising of the Products in accordance with this
						Agreement.  At the Company’s request, Dealer shall immediately
						provide the Company copies of any and all of Dealer’s advertising
						utilizing any Company Marks.  Upon termination of the Agreement or
						earlier request by the Company, Dealer shall immediately discontinue
						use of the Company Marks.  Dealer’s breach of any of its
						obligations under this paragraph may subject Dealer to injunctions,
						damages and/or payment of any costs and reasonable attorneys’ fees
						incurred by the Company and/or the true owner of the Company Marks
						arising out of any such breach.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>7.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>New
						Account Setup &amp; Credit Terms</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						acknowledges that new account setup may take approximately two (2)
						weeks.  For Electronic Data Interchange (“EDI”) accounts,
						additional time may be required for setup and testing before any
						shipments will be processed.  Dealer shall comply with all credit
						terms implemented from time to time by the Company.  Dealer must
						complete, sign and submit the Company’s “New Account Credit
						Application” document as a prerequisite to credit evaluation and
						account setup.  Dealer acknowledges that any and all requested credit
						terms are not guaranteed, that any and all credit terms shall be
						established within the sole and absolute discretion and approval of
						the Company and its accounting department, and that the Company
						reserves the right to change Dealer’s credit terms from time to
						time.  Dealers requesting shipment prior to credit approval must pay
						for Products and all applicable freight charges in full prior to
						shipping.  If, in the Company’s sole and absolute judgment, the
						financial condition of Dealer at any time prior to delivery does not
						justify the terms of payment specified, the Company may require
						additional assurance, information, letters of credit, personal
						guarantees or advance payment as a condition to shipping Products. 
						However, nothing in this Agreement shall be construed to require the
						Company to accept, process or deliver Products pursuant to any order,
						regardless of whether security has been provided to the Company by
						Dealer.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>8.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Payment
						Terms</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						agrees to make payment in accordance with the schedule and amounts
						set forth in the invoices provided by the Company to Dealer and to
						comply on a continuing basis with all credit terms established from
						time to time by the Company.  Each Dealer account must be in good
						standing at all times, failing which the Company may place a credit
						hold on such account.  If a credit hold is placed on any Dealer
						account, the Company has the right to place all other related
						accounts of Dealer on hold until all such accounts are brought
						current.  If any Dealer account is placed on credit hold, all pending
						orders may be cancelled. </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Company will accept payment via check or any of the following credit
						cards:  MasterCard, Visa, American Express. Should any payment by credit card not clear within
						five (5) days of order placement, the Company reserves the right to
						immediately cancel any and all orders associated with said credit
						card.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer’s
						failure to comply with all credit terms or pay invoices when due, or
						the post-dating or bouncing of checks, are grounds for order
						cancellation(s) and/or non-shipment and shall, in the Company’s
						sole and absolute discretion, cause any outstanding invoices to
						become immediately due and payable.  Furthermore, a service charge of
						one percent (1%) per month shall be charged on all overdue amounts. A
						twenty-five dollar ($25) service charge shall be assessed for each
						returned check and upon any occurrence of insufficient funds.  In the
						event the Company incurs expenses on any attempt to collect payment,
						Dealer shall pay, upon demand, all costs, collection fees and other
						expenses incurred by the Company, including, but not limited to,
						attorneys’ fees and costs.  If any outstanding invoices become
						thirty (30) days past due, Dealer authorizes the Company to charge
						the entire outstanding balance amount, as well as any applicable
						collections fees and costs, to Dealer’s credit card account on
						file.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>It
						is Dealer’s responsibility to inspect all shipments and to notify
						the Company of any claims or invoice discrepancies within thirty (30)
						days of the invoice date.  The Company will not accept or address any
						disputes regarding orders, invoices, Products, or shipments thereof
						after such thirty (30) day period, and Dealer hereby expressly waives
						any such claim or dispute if not brought within said thirty (30) day
						period.  Deduction from payments to the Company will not be allowed
						unless and until a credit memo is issued by the Company.  Any
						deductions taken by Dealer without the Company’s prior approval
						will be shown as shortages on account balances.  Dealer further
						acknowledges that any price discounts allowed by the Company are
						conditioned upon timely payment in accordance with Company invoices,
						and agrees to pay the full, non-discounted price for any Products for
						which full and timely payment is not made in accordance with the
						invoice terms.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>9.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Taxes
						&amp; Fees</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						purchase price of any Product does not include any federal, state,
						county, municipal or local property, license, sales, service, use,
						excise, value added, gross receipts or other taxes which may now or
						hereafter be applied to, measured by or imposed upon or with respect
						to any transaction hereunder, the Products, their purchase, sale,
						replacement value or use.  Dealer shall reimburse the Company for any
						such taxes for which the Company may become liable or required to pay
						in connection with Products sold to Dealer.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>10.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Ordering</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						acknowledges that the minimum order quantity is three (3) pairs. 
						Orders fewer than three (3) pairs shall be assessed a five dollar
						($5.00) per order handling fee.  At-once orders may be submitted to
						the Company via e-mail, facsimile or telephone.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>For
						future orders, Dealer shall provide the Company with a definitive
						cancel date at the time of order placement.  Should Dealer fail to
						provide a cancel date, the Company shall assign a cancel date of
						ninety (90) days from the date of order placement.  Dealer shall
						notify the Company, in writing, of any and all cancellations
						regarding a future order no later than seven (7) days prior to
						the date set for shipment of the future order.  If the Company does
						not so timely receive such changes or cancellations within the
						seven (7) day time period, and the order ships, Dealer shall be
						responsible for all freight charges and a ten percent (10%) per order
						restocking fee.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>It
						shall be Dealer’s responsibility to ensure that all orders are
						finalized prior to submission to the Company.  Dealer acknowledges
						that once an order is submitted to the Company, no further changes
						may be made to that order except within the sole and absolute
						discretion of the Company, and that a new order must be generated to
						allow for any changes desired by Dealer.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Company may issue order confirmations for each order submitted.  It
						shall be Dealer’s responsibility to review the order confirmation
						for accuracy and to immediately notify the Company of any and all
						discrepancies.</FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>11.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Shipping
						&amp; Delivery</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						acknowledges that the Company’s accounting department must clear an
						account prior to an order being released for shipping, and that order
						shipments may be withheld by the Company due to account status.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						shall bear all freight fees, shipping charges and related insurance
						costs for orders made under this Agreement.  The Company shall make
						every commercially reasonable effort to ship within a reasonable
						period of order receipt.  Dealer acknowledges that delivery dates
						provided by the Company are estimates only, not actual guaranteed
						delivery dates, and that from time to time, especially during peak
						seasons, additional time may be required for fulfillment of orders. 
						The Company shall not be liable for loss or delays in the shipping of
						Products, including, but not limited to, those resulting from
						shortages in transportation or manufacturing.  All installment
						deliveries shall be separately invoiced and paid for without regard
						to subsequent deliveries.  The Company reserves the right to
						determine shipping priority based on any factor, including past
						payment history.  For shipment of future orders, the Company reserves
						the right to ship all orders up to fourteen (14) days prior to
						Dealer’s requested ship date, as the Product(s) becomes available,
						without penalty.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Unless
						otherwise specified, the Company’s default shipping carrier for
						shipments under two-hundred (200) pounds shall be United Parcel
						Service (“UPS”) Ground.  For shipments over two-hundred (200)
						pounds, EDI Express shall be the default less-than-truckload (“LTL”)
						shipping carrier.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Orders
						shall be shipped F.O.B. Ontario, California.  If a shipment is
						refused by Dealer for any reason other than shipper error, Dealer
						shall be assessed a ten percent (10%) per order restocking fee, plus
						freight costs, associated with the refused shipment.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>12.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Drop
						Shipments</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Subject
						to prior advanced approval within the Company’s sole and absolute
						discretion, the Company may agree to drop ship for Dealer.  In
						addition to any standard applicable shipping and handling fees, drop
						shipments will be assessed a Drop Ship Fee of $5.00 per order.  All
						drop ship orders shall be packed in Company-branded cartons unless
						Dealer timely supplies alternative cartons.  The Company may insert
						supplemental materials in drop ship order boxes upon Dealer’s
						timely provision of said materials to the Company.  If a drop
						shipment is refused for any reason, a twelve dollar ($12.00) refusal
						fee shall be deducted from the Return Authorization (“RA”)
						number.  Returned drop shipments to Dealer must be processed within
						thirty (30) days of shipment and Dealer shall be assessed a ten
						percent (10%) per order restocking fee.  The Company reserves the
						right to reject and/or cease drop shipments for Dealer at any time,
						in its sole and absolute discretion.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>It
						shall be Dealer’s responsibility to provide an accurate shipping
						address for all drop shipments.  Dealer shall be responsible for all
						freight costs, handling fees and all other expenses associated with
						Dealer’s provision of an inaccurate shipping address for drop
						shipments.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>13.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Title
						&amp; Risk of Loss</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Products will remain the personal property of the Company until paid
						for in full in good funds and, if requested by the Company, Dealer
						shall execute a security agreement covering the Products sold and
						perform all acts necessary to perfect and assure a security interest
						in such Products by the Company.  Any agreement with respect to
						passage of legal title to the Products to the contrary
						notwithstanding, risk of loss and damage shall pass to Dealer, and
						delivery will be deemed complete, upon delivery by the Company of the
						Products to any shipper, F.O.B. Ontario, California.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>14.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Trans-Shipping</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						shall only sell Products at physical locations and Internet-based
						applications approved in writing in advance by the Company.  Dealer
						shall not sell, distribute, market, ship or otherwise convey rights
						in any Products to any person or entity who has not previously been
						approved by the Company.  Subject to the foregoing, Dealer shall
						engage in retail sales to end-users only and shall not sell Products
						to other retailers, wholesalers, distributors, exporters or any
						person or entity with the intent to resell the Products.  This
						paragraph is an essential term of this Agreement, the breach of which
						shall constitute a total repudiation of this Agreement by Dealer.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>15.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Returns</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						acknowledges that the returns process is an interactive one and
						agrees to use best efforts to engage with the Company in the
						processing of returns.  Dealer acknowledges that failure to use such
						best efforts may result in the Company’s refusal to process any
						returns and may also result in the withholding of order shipments to
						Dealer.  It shall be Dealer’s responsibility to use best efforts to
						assist all end users with regard to returns sent to Dealer,
						including, but not limited to, obtaining a RA number from the Company
						for all end users. </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Returns
						will be accepted by the Company only for Products deemed to be
						defective in the Company’s sole and absolute discretion.  No
						Product may be returned unless the Dealer has first notified the
						Company and received a RA number.  The RA number must be clearly
						displayed on the packaging in which such Product(s) is sent, or the
						return will not be accepted.  Dealer will have thirty (30) days after
						the date the RA number is issued to return the Product(s) to the
						Company.  All returns, regardless of reason, must be shipped freight
						prepaid.  Under no circumstance will the Company offer call tags with
						respect to returns.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>All
						returned shoes will be inspected upon receipt at the Company’s
						returns facility.  If the reason for return is deemed to be, in the
						Company’s sole and absolute discretion, a manufacturer’s defect,
						the Company will issue return credit, including reasonable cost of
						return freight, generally in the form of a credit memo.  If, in the
						Company’s sole and absolute discretion, return authorization is
						given for a non-defective Product(s), a ten percent (10%) per order
						restocking fee shall be assessed to Dealer.  Such restocking fee
						shall also be assessed to Dealer for returns with invalid RA numbers
						and for orders that are ready to ship but untimely cancelled by
						Dealer.  The Company reserves the right to reject any and all
						non-defective returns sent by Dealer and/or to ship said
						non-defective returns back to Dealer, in which event Dealer
						acknowledges that Dealer will be responsible for any and all freight
						charges associated with shipping the non-defective returns back to
						Dealer.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>All
						Product(s) to be returned to the Company must be properly packaged
						and wrapped in sturdy shipping cartons such that all Product(s), and
						all boxes and other packaging materials in which such Product(s) are
						shipped, displayed or sold, are in proper condition to be sold as
						new.  If Product(s) and/or packaging materials are not returned in a
						condition to be sold as new, the Company, in its sole and absolute
						discretion, may return such Product(s) to Dealer without return
						credit or allow only partial credit, in which event Dealer
						acknowledges that Dealer will be responsible for any and all freight
						charges associated with shipping back to Dealer.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>If
						returning more than six (6) pairs at one time, Dealer shall contact
						its sales representative prior to initiating any return procedure
						directly with the Company.  Returns of footbeds require a minimum of
						ten (10) pairs, and that the Company may not accept returns of
						footbeds comprising less than said minimum quantity.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>16.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Force
						Majeure</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Company shall not be liable for loss, damage, detention or delay
						attributable to, nor be deemed to be in default as a result of or
						relating to, events and conditions beyond its reasonable control, or
						from fire, strike or other concerted actions of workers, any act or
						omission of any governmental authority or of Dealer, compliance with
						import or export regulations, currency restrictions, insurrection or
						riot, embargo, delays or shortages in transportation, or inability to
						obtain labor, material or manufacturing facilities from usual
						sources.  In the event of delay by the Company relating to any such
						cause, the date of delivery shall be postponed by such length of time
						as may be reasonably necessary to compensate for the delay.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>17.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Entire
						Agreement, Amendment &amp; Termination</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>This
						Agreement is the final, complete and exclusive agreement of the
						Parties hereto with respect to the subject matter hereof and
						supersedes and merges all prior communications, documents and
						agreements between the Parties.  This Agreement may be amended in
						only two (2) ways:  (1) a written amendment executed by both Parties;
						or (2) the Company may amend this Agreement from time to time, and
						the posting of said amended Agreement on the Company’s dealer
						website, <A HREF="http://www.dealer.alegriashoes.com">http://www.dealer.alegriashoes.com</A>,
						shall be deemed a sufficient method of providing notice of said
						amendments.  This Agreement may be terminated at will, for any reason
						or no reason, by the Company upon ten (10) days’ written notice to
						Dealer.  Notice via e-mail to Dealer shall be deemed sufficient
						notice of any such termination of this Agreement.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>18.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Waiver</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Failure
						of the Company to require performance of any provisions hereof shall
						not affect the right of the Company to require performance of that or
						any other provision at any time thereafter.  No waiver by the Company
						of any breach of this Agreement shall be a waiver of any preceding or
						succeeding breach.  No waiver by the Company of any right under this
						Agreement shall be construed as a waiver of any other right.</FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>19.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Severability</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						provisions of this Agreement shall be deemed to be severable and the
						invalidity or unenforceability of any provision shall not affect the
						validity or enforceability of the other provisions hereof.  If any
						provision of this Agreement, or the application thereof to any person
						or any circumstance, is held to be invalid or unenforceable under
						present or future laws effective during the term of this Agreement,
						such provision shall be fully severed, and in lieu thereof there
						shall automatically be added a suitable and equitable provision in
						order to carry out, so far as may be valid and enforceable, the
						intent and purpose of such invalid or unenforceable provision.</FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>20.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Governing
						Law &amp; Venue</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.14in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>This
						Agreement and the respective rights and obligations of the Parties
						hereunder shall be governed by the laws of the State of California.
						The Parties irrevocably agree that any action, suit, mediation,
						arbitration or other proceeding arising out of or related to this
						Agreement or the relationship between the Parties created hereby
						shall be conducted only in state or federal courts located in the
						County of San Bernardino, California. The Parties irrevocably waive
						any objection to such venue, including, but not limited to,
						objections based on an inconvenient forum.</FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>21.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Assignment
						&amp; Binding Effect</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						may not assign any rights or obligations under this Agreement except
						with the prior written consent of the Company.  Dealer hereby agrees
						to notify the Company, in writing, of any proposed changes in
						ownership or ownership structure at least thirty (30) days in
						advance.  This Agreement shall be binding upon and inure to the
						benefit of the Parties and their respective heirs, legal and personal
						representatives, successors and permitted assigns.</FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>22.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>No
						Extra-Contractual Relationships Created</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Nothing
						in this Agreement shall be construed to create between the Parties
						any partnership, joint venture, agency, franchise, sales
						representative or employment relationship.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>23.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Headings</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						section headings contained in this Agreement are solely for the
						purpose of convenience and shall neither be deemed a part of this
						Agreement nor used in any interpretation hereof.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>24.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Authority
						to Execute</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						hereby represents that the person electronically executing this
						Agreement is authorized to enter into this Agreement on behalf of
						Dealer, that Dealer fully understands the terms and conditions
						hereof, has had the opportunity to consult an attorney regarding this
						Agreement, and that Dealer will fully comply with all terms and
						conditions of this Agreement.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3><U><B>PEPPER
						GATE FOOTWEAR E-COMMERCE POLICY</B></U></FONT></FONT></P>
						<P ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>This
						E-Commerce Policy (“Policy”) shall supplement the Dealer
						Agreement and General Business Policies (“Agreement”) made and
						entered into by and between you (“Dealer”), on the one hand, and
						Pepper Gate Footwear, Inc., a California corporation (“Company”),
						on the other hand (hereinafter, the “Company” and the “Dealer”
						shall collectively be known as the “Parties”).  All capitalized
						terms not defined herein shall have the meanings ascribed to them in
						the Agreement.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>1.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Company
						Pre-Approval Required for Internet-Based Applications</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Should
						Dealer desire to sell or feature any Product(s) bearing any Company
						Marks on any Internet-based applications, Dealer must first submit
						any and all such Internet-based applications to the Company for
						written pre-approval, such pre-approval being within the sole and
						absolute discretion of the Company.  Each Internet-based application
						featuring or containing any Company Marks or offering for sale any
						Products bearing any Company Marks (“Subject Application(s)”)
						must first obtain the Company’s written pre-approval, such
						pre-approval being within the sole and absolute discretion of the
						Company.  The sale or offering for sale of Products via unauthorized
						Internet-based applications shall constitute a violation of this
						Policy and a breach of the Agreement.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Company may, from time to time, require written undertakings from the
						operator of any Subject Application.  The Company reserves the right
						to reject, in whole or in part, any Internet-based application, and
						to withdraw its prior approval for any material of which it
						previously approved if, in the sole and absolute discretion of the
						Company, the Internet-based application may be detrimental to the
						Company Marks, the Company’s goodwill and/or reputation, or the
						public image of the Company or its Products.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>2.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Content;
						Modification Thereof</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						is responsible for any and all content on any Subject Application. 
						It is Dealer’s duty to ensure that such content does not infringe
						upon the rights of any third party.  Prior to any amendment or
						modification of any Subject Application or the contents thereof,
						Dealer must first obtain the Company’s written pre-approval, such
						pre-approval being within the sole and absolute discretion of the
						Company.  The Company reserves the right to reject, in whole or in
						part, any descriptions, depictions, photographs, videos, images,
						drawings and/or likenesses pertaining to the Company or any of its
						Products on any Subject Application, and to withdraw its prior
						approval for any such content of which it previously approved if, in
						the sole and absolute discretion of the Company, such content may be
						detrimental to the Company Marks, the Company’s goodwill and/or
						reputation, or the public image of the Company or its Products.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>3.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Adequacy
						of Internet-Based Applications</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Should
						Dealer obtain the Company’s approval for any Internet-based
						application(s) for the sale of the Products, Dealer agrees to the
						following:  (a) to ensure that the Internet-based application(s) is
						appropriately set up and equipped to service any and all transactions
						and inquiries of the viewing public; (b) to provide for a secure
						server for online financial transactions; (c) to maintain a high
						level, to be determined at the Company’s sole and absolute
						discretion, of customer service, including, but not limited to,
						timely, accurate fulfillment of customer orders and timely, accurate
						and adequate handling of customer returns, complaints and queries;
						(d) to carry a stock of Products sufficient to meet its level of
						sales.  All Subject Applications must meet the minimum standards set
						by the Company from time to time, in its sole and absolute
						discretion.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>4.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Physical
						Retail Location Required</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Company
						approval of any of the Dealer’s Internet-based applications is
						strictly contingent upon, </FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><I>inter
						alia</I></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2>,
						Dealer’s maintenance of a Company-approved physical retail location
						established and maintained for the sale of merchandise including, but
						not limited to, the Products.  Such physical retail location must
						generate not less than five-thousand dollars ($5,000) in annual
						retail sales of the Products.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Company reserves the right to terminate the account and withhold any
						and all pending and future product shipment(s) of the Dealer should
						Dealer resell any Products to any person or entity that does not
						operate and maintain a physical retail location established and
						maintained for the sale of merchandise including, but not limited to,
						the Products.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>5.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Resemblance
						to Company’s Internet-Based Applications Prohibited</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						is prohibited from creating, obtaining and/or maintaining any
						Internet-based application that, in any manner, duplicates or
						resembles, in the Company’s sole and absolute discretion, the look
						and feel of any of the Company’s Internet-based applications. 
						Dealer is prohibited from using any Company Marks or the words
						“alegria,” “alegriabypglite,” “pglite,” or “peppergate”
						in any domain name or URL without the prior written approval of the
						Company, such prior written approval being within the sole and
						absolute discretion of the Company.  At any time, should the Company
						discover Dealer’s use of such Company Marks or words in any domain
						name or URL, upon the Company’s request, Dealer agrees to
						immediately transfer any such domain name or URL to the Company, at
						no cost to the Company.</FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in">  
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>6.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Aggregator
						&amp; Auction Site Sales Prohibited</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Dealer
						agrees to refrain from selling, offering to sell or making available
						for sale any Products on aggregator or auction sites, including, but
						not limited to, sites such as eBay, Google Shopping, Yahoo! Shopping
						and Bing Product Search.  Dealer further agrees to refrain from
						selling or offering to sell any Products to any person or entity who
						Dealer reasonably believes has offered or sold, or intends to offer
						or sell, the Products on aggregator or auction sites.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>	</FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>7.	</B></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><U><B>Drop
						Shipments for Internet Sales</B></U></FONT></FONT><FONT FACE="Times New Roman, serif"><FONT SIZE=2><B>:</B></FONT></FONT></P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>The
						Company will drop ship orders for Internet sales on behalf of Dealer
						at its sole and absolute discretion, in accordance with the terms and
						conditions of the Agreements.  </FONT></FONT>
						</P>
						<P ALIGN=JUSTIFY STYLE="margin-bottom: 0in"><BR>
						</P>
					</div>
					<br /><br />
					<div id="submitform">
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="agreeform" onsubmit="return checkCheckBox(this)">
							<div>
								<input type="hidden" name="username" value="<?php echo $username ?>">
								<input type="checkbox" name="agree" value="1">
								<label for="agree"> I have read, understand and agree to Pepper Gate Footwear, Inc.’s 
									“Dealer Agreement & General Business Policies” and “E-Commerce Policy.”.</label>
							</div>
							<br /><br />
							<div>
								<input type="submit" name="submit" value="I agree!"> 
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		function checkCheckBox(f){
			if (f.agree.checked == false )
			{
			alert('You must check the box to agree to our terms!');
			return false;
			} else
			return true;
			}
		</script>
	</body>
</html>