<table width="100%" class="mod_list">
    <tr>
        <td width="35%">Username:</td>
        <td width="6%"><img src="files/images/icons/user.png" border="0px"></td>
        <td width="69%"><a href="personal/user-info?user=<?=$user->info->username; ?>"><?=$user->info->username; ?></a></td>
    </tr>
    <tr>
        <td width="35%">Health:</td>
        <td width="6%"><img src="files/images/icons/heart.png" border="0px"></td>
        <td width="69%"><a href="locations/hospital"><?=$user->stats->health; ?>%</a></td>
    </tr>
    <tr>
        <td width="35%">Power:</td>
        <td width="6%"><img src="files/images/icons/lightning.png" border="0px"></td>
        <td width="69%"><a href="locations/shop"><?=$settings->createFormat($user->stats->power); ?></a></td>
    </tr>
    <tr>
        <td width="35%">Money (cash):</td>
        <td width="6%"><img src="files/images/icons/money.png" border="0px"></td>
        <td width="69%"><a href="locations/bank"><?=$settings->currencySymbol()." ".$settings->createFormat($user->stats->money); ?></a></td>
    </tr>
    <tr>
        <td width="35%">Money (bank):</td>
        <td width="6%"><img src="files/images/icons/bank.png" border="0px"></td>
        <td width="69%"><a href="locations/bank"><?=$settings->currencySymbol()." ".$settings->createFormat($user->stats->bank); ?></a></td>
    </tr>
    <tr>
        <td width="35%">Rank:</td>
        <td width="6%"><img src="files/images/icons/rank.png" border="0px"></td>
        <td width="69%"><?=$info['ranks'][$user->stats->rank]; ?></td>
    </tr>
    <tr>
        <td width="35%">Credits:</td>
        <td width="6%"><img src="files/images/icons/coins.png" border="0px"></td>
        <td width="69%"><a href="call-credits/shop"><?=$user->stats->credits; ?></a></td>
    </tr>
    <tr>
        <td width="35%">VIP:</td>
        <td width="6%"><img src="files/images/icons/star.png" border="0px"></td>
        <td width="69%"><a href="call-credits/shop">-</a></td>
    </tr>
    <tr>
        <td width="35%">Rank process:</td>
        <td width="6%"><img src="files/images/icons/wand.png" border="0px"></td>
        <td width="69%"><?=$user->stats->rank_process; ?>%</td>
    </tr>

    <tr>
        <td width="35%">City:</td>
        <td width="6%"><img src="files/images/icons/world.png" border="0px"></td>
        <td width="69%"><a href="locations/airport"><?=$info['cities'][$user->stats->city]; ?></a></td>
    </tr>
    <tr>
        <td width="35%">Family:</td>
        <td width="6%"><img src="files/images/icons/drive_user.png" border="0px"></td>
        <td width="69%"><a href="family/profile?id=<?=$user->family->id; ?>"><?=$user->family->name; ?></a> </td>
    </tr>
    <tr>
        <td width="35%">Protection:</td>
        <td width="6%" align=center><img src="files/images/icons/shield.png" border="0px"></td>
        <td width="69%"><?=($stats->protection > time()) ? date("Y-m-d H:i", $stats->protection) : 'None protection'; ?></td>
    </tr>
    <tr>
        <td width="35%">Mijn secret link:</td>
        <td width="6%"><img src="files/images/icons/ruby_link.png" border="0px"></td>
        <td width="69%"><a href="#">-</a></td>
    </tr>
    <tr>
        <td width="35%">Secret link info:</td>
        <td width="6%"><img src="files/images/icons/information.png" border="0px"></td>
        <td width="69%">When somebody clicks your secret link, you get: 500 cash, 1000 bank and 1 killer extra.</td>
    </tr>
</table>