<?php
/**
 * Created by PhpStorm.
 * User: Hajay
 * Date: 2018/1/3
 * Time: 上午9:57
 */
require_once "../common/data/include.php";
$disclaimer = array(
    'en' => array(
        '1001' => '<p style="font-weight: bold;">I.	[Objective]</p>
<p>BITUP.COM (hereinafter referred to as “we” or “us”) has established and implemented the anti-money laundering and antiterrorism financing and trading and economic sanction scheme according to the applicable laws and international practice. BITUP.COM is dedicated to boosting a legal, safe and transparent commercial platform and keeping a good reputation among users, regulatory institutions and the digital asset industry.</p>
<p style="font-weight: bold;">II.	[Business model]</p>
<p>We, as a digital asset management platform set up in Singapore, provide the professional digital asset combinations and adopt the scientific and effective digital asset configuration manner, so as to help investors from each level access the digital asset field, properly manage their various digital assets, allocate investment risks accompanying single digital assets and increase overall benefit of digital assets. Users buy or sell out digital asset combinations (hereinafter referred to as “DAC”) on our platform.</p>
<p style="font-weight: bold;">Tips: Transactional risks</p>
<p>Trading and holding digital assets and digital asset combinations are accompanied by high risks. Therefore, you are required to carefully consider whether you are suitable for trading based on your actual economic situation.</p>
<p style="font-weight: bold;">III.	[Current regulatory situation]</p>
<p>We have understood that the regulatory authority has taken multiple measures for regulating and standardizing digital assets, such as defining or classifying digital assets as virtual currency, cryptocurrency or digital currency according certain practical business contents. As a trading platform or trading market, we consider Bitcoin, Ethereum (and other token money) as a kind of emerging innovative assets. Therefore, digital assets shall not be called as money or currency.</p>
<p style="font-weight: bold;">Tips: Digital assets are not money or legal tender</p>
<p>BITUP.COM does not believe digital assets as money or legal tender. Bitcoin, Ethereum and other digital assets are not backed up or supported by any government or central bank.</p>
<p>However, considering our service object is users who want to invest in DAC relying on digital assets, we are dedicated to making the perfect anti-money laundering and antiterrorism financing and sanction scheme. We are committed to completely observing rules, regulations and regulatory policies of every country, and regularly discussing with regulatory institutions and peers to find out the optimal method for conducting the digital asset business. Singapore is committed to establishing a safe and compliant digital asset trading platform industry and meanwhile, BITUP.COM will obey contents and spirit of such regulatory guidelines, including taking measures for Know Your Customer, monitoring suspicious activities, reporting suspicious transactions and cooperating with the relevant local department who requires check of trading information. We will not undertake any responsibility for actions taken in order to execute the relevant regulatory guidelines of Singapore and the resulted consequences.</p>
<p style="font-weight: bold;">Statement: We cooperate with government departments</p>
<p>We respect regulatory provisions and strictly obey those applicable provisions. It also means our platform is only open to law-abiding users. We hope to provide service for you and we also hope you could conduct legal business pursuant to laws on our platform.</p>
<p>Considering the law-enforcing department may require us to provide information, as a good enterprise citizen, we will provide assistance to the law-enforcing department as specified by laws and regulatory policies. We are not liable for consequences resulted in by providing information or assistance required by the law-enforcing department.</p>
<p>In addition, in order to boost sound operation, we will check users (including owners of actual incomes) through comparison with institutions/personnel published on the “Sanction List of the United Nations Security Council” and with the list concerning organizations and personnel that Singapore Government requires to note and who are suspected being involved in terrorist activities. In addition, we will also check them through comparison with other lists, in order to identify those who are not consistent with user qualification to protect our reputation and users.</p>
<p style="font-weight: bold;">Statement: We are entitled to reject some users</p>
<p>Because BITUP.COM is an enterprise founded in Singapore, we follow the local laws and the relevant foreign laws (if applicable). At present, several countries have forbidden activities involving digital assets, and we strictly follow the local laws and regulations, as well as regulatory requirements within the judicial scope of each country. In order to maintain our good reputation at the market and comply with the distinct regulatory requirements of several jurisdictions, we are entitled to determine to serve or not to serve users coming from part of countries or areas according to our independent judgment, for which, we will be entitled not to provide additional explanation or undertake any liability.</p>
<p style="font-weight: bold;">IV.	[Our anti-money laundering and antiterrorism financing scheme]</p>
<p>We have designed our anti-money laundering and antiterrorism financing scheme with the purpose of reasonably preventing money laundering and terrorism financing relying on the risk-based multi-level control system. The first level of this scheme involves the strict user identity identification procedures, including verifying identity of an individual or a user. The second level contains the risk-based system control so as to ensure that the additional customer due diligence could be conducted. The third level contains continuously monitoring suspicious activities. These are the major components of our compliance plan. However, the most important link of these activities contained by this multi-level risk control system is our leading team and employees, including anti-money laundering/risk control personnel who are responsible for providing training and supervising and creating the good compliance culture. If you have any doubt for our customer due diligence control or need our help, please contact our 7x 24 customer service representative at any time by sending e-mails to support@bitup.com.</p>'
    ),
    'cn' => array(
        '1001' => '<p style="font-weight: bold;">I.【目的】</p>
<p>BITUP.COM（以下称“我们”）按照适用法律和国际惯例建立并实施了反洗钱、反恐怖主义融资和贸易经济制裁方案。BITUP.COM致力于推进一个合法、安全、透明的商业平台，并在用户、监管机构和数字资产行业中保持良好的声誉。</p>
<p style="font-weight: bold;">II.【业务模式】</p>
<p>我们是一家设立在新加坡的数字资产管理平台，通过提供专业的数字资产组合产品，采取科学有效的数字资产配置方式，帮助各层次的投资者进入数字资产领域，妥善管理好各种数字资产，分散单个数字资产的投资风险，提高数字资产的整体收益。用户在我们的平台上买入或卖出数字资产组合产品（以下简称“DAC”）。</p>
<p style="font-weight: bold;">提示：交易有风险</p>
<p>交易和持有数字资产、数字资产组合有较高风险。因此，您应该根据您的经济状况仔细考虑您是否适合进行交易。</p>
<p style="font-weight: bold;">III.【监管现状】</p>
<p>我们了解到监管机构对数字资产的监管与规范采取了多种方式，包括根据某些实际业务内容，将数字资产定义或归类为虚拟货币、加密货币或数字货币。作为一个交易平台或交易市场，我们认为比特币和以太坊（以及其他代币）等数字资产是一种新兴的创新型资产。因此数字资产不应被称为钱或货币。</p>
<p style="font-weight: bold;">提示：数字资产不是钱或法定货币</p>
<p>BITUP.COM不认为数字资产是钱或法定货币。比特币和以太坊等数字资产不以任何政府或中央银行为后盾支持。</p>
<p>然而，由于我们服务于想用数字资产投资DAC的用户，所以我们致力于建立完善的反洗钱、反恐怖主义融资及制裁方案。我们致力于全面遵守各国的规章制度及监管政策，并定期与监管机构和同行探讨开展数字资产业务的最佳方法。新加坡致力于建立一个安全合规的数字资产交易平台行业，BITUP.COM将会遵守这些监管指引的文字和精神，包括执行“了解您的客户”（ Know Your Customer）措施，监控可疑活动，报告可疑交易，并与当地要求查询交易信息的有关部门进行合作。我们对因执行新加坡相关监管指引所开展的行动及引发的后果不承担任何责任。</p>
<p style="font-weight: bold;">声明：我们与政府部门合作</p>
<p>我们尊重监管规定并严格遵守应适用的规定。这也意味着我们的平台仅适用于守法的用户。我们希望能为您提供服务，我们也希望您在我们的平台上能够依法合法地行事。
<p>执法部门可能会要求我们提供信息，作为良好的企业公民，我们将按照法律及监管政策的规定向执法部门提供协助。我们对因向执法部门提供其要求的信息或协助所引发的后果不承担任何责任。</p>
<p>此外，为了促进健康地经营，我们将对用户（包括实益拥有人）在 “联合国安理会制裁清单”公布的机构/人员及新加坡要求关注的涉嫌恐怖活动的组织及人员名单中进行比对，我们也将酌情在其他名单中进行比对，以识别不符合用户资格的人员，以保护我们的声誉和用户。</p>
<p style="font-weight: bold;">声明：我们有权不接受某些用户</p>
<p>BITUP.COM是在新加坡成立的企业， 我们遵从当地法律及相关的外国法律（若适用的话）。目前，部分国家已经禁止涉及数字资产的活动，我们在各国司法管辖范围内严格遵守当地的法律法规和监管要求。为了保持在市场上的良好声誉，并遵守某些司法管辖区的独特监管要求，我们有权根据自身的独立判断决定服务或不服务于来自部分国家或地区的用户，并且我们有权对此不提供额外解释、不承担任何责任。</p>
<p style="font-weight: bold;">IV.【我们的反洗钱、反恐怖融资方案】</p>
<p>我们设计了我们的反洗钱和反恐怖融资方案，通过基于风险的多层次控制系统以合理防止洗钱和恐怖主义融资。该方案的第一层包括严格的用户身份识别程序，包括验证个人和用户的身份。第二层包括基于风险的系统控制，以保证额外的客户尽职调查得以执行。第三层包括持续监控可疑活动。这些是我们合规计划的主要组成部分；然而，这些多层次风控系统的最重要的纽带是我们的领导团队和员工，包括执行培训，监督并形成良好合规文化的反洗钱/风控人员。如果您对我们的客户尽职调查控制有疑问或需要我们帮助，请随时通过电子邮件support@bitup.com与我们的7×24客户服务代表联系。</p>'
    )
);
$l = $_COOKIE['BT_LANG'];
$_Disclaimer = $disclaimer[$l];
$title = 'BitUP Disclaimer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../common/tpl/meta.php'; ?>
</head>
<body>
<?php include_once '../common/tpl/header.php'; ?>

<div class="guide-main common-container other-page-main">
    <ul class="menu-slide">
<!--        <li>-->
<!--            <a href="/about/" class="title"><span>--><?php //echo $_Lang['100025']; ?><!--</span></a>-->
<!--        </li>-->
<!--        <li>-->
<!--            <a href="/dac/" class="title"><span>--><?php //echo $_Lang['100026']; ?><!--</span></a>-->
<!--        </li>-->
        <li>
            <a href="/tos/" class="title"><span><?php echo $_Lang['100027']; ?></span></a>
        </li>
        <li class="current">
            <a href="/disclaimer/" class="title"><span><?php echo $_Lang['100028']; ?></span></a>
        </li>
    </ul>
    <div class="content-panel">
        <h3 class="title"><?php echo $_Lang['100028']; ?></h3>
        <p><?php echo $_Disclaimer['1001']; ?></p>
    </div>
</div>

<?php include_once '../common/tpl/footer.php'; ?>

</body>
</html>