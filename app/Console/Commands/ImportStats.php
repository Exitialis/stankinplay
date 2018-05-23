<?php

namespace App\Console\Commands;

use App\Models\Statistics;
use Illuminate\Console\Command;

class ImportStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tmp = json_decode('{"steamid":"76561198036287521","personaname":"B4zzle","avatar":"https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/32/32d65416079c758817b1d22682503c338858e0ba_full.jpg","realname":"","lastSeenString":"Last seen on 22 May","rank":15,"rank_title":"Legendary Eagle","level":30,"level_title":"Major","xp":4580,"wins":571,"cmd_friendly":12,"cmd_teacher":12,"cmd_leader":10,"featured_medal":1026,"medals":[1026,1336,1339,874,1329,1318,1029,1001,1013],"medal_weapon":3,"medal_team":2,"medal_global":2,"medal_combat":2,"medal_arms":2,"bans":{"EconomyBan":"none","NumberOfGameBans":0,"DaysSinceLastBan":0,"NumberOfVACBans":0,"VACBanned":false,"CommunityBanned":false,"SteamId":"76561198036287521"},"killChanges":554,"deathChanges":0,"timeChanges":"2.98hrs","mvpChanges":16,"changesSinceDate":"20 May","winChanges":"0.00","accChanges":"0.00","hsChanges":"0.00","kdrChanges":"0.00","is_private":false,"hours_played":1428,"latest_match":{"score":0,"money":"$0","dmg":"3833 HP","mvps":1,"deaths":23,"kills":32,"fwkills":3,"fwaccuracy":"31.3%","totalRounds":1,"roundsWon":1,"victory":"VICTORY","favweaponShort":"m4a1","favweaponPretty":"M4","roundWins":1,"kdr":"1.39"},"other_stats":{"kills":"105,975","deaths":"83,724","headshots":"39,680","totalmoney":"$174,466,870","damagedone":"15,068,044 HP","score":"539,673","bombsplanted":2237,"bombsdefused":468,"hostagesrescued":21,"matchesplayed":4006,"matcheswon":1463,"roundsplayed":"66,118","rounds":"33,735","mvps":8557,"weaponsdonated":"11,054","killsenemyweap":7966,"blindedkills":1383,"knifefight":225,"killedsniper":9343,"shots":"1,501,094","hits":"309,998","doms":2435,"domoverkills":2583,"revenges":641,"pistolwins":2243,"tasers":44,"windows":746,"timeplayed":"1429h."},"favWeapon":{"name":"AK-47","rawName":"ak47","kills":"30,485","rawKills":30485},"favWeapons":[{"name":"AWP","rawName":"awp","kills":"24,078","rawKills":24078},{"name":"M4","rawName":"m4a1","kills":"14,522","rawKills":14522},{"name":"P2K & USP","rawName":"hkp2000","kills":6197,"rawKills":6197},{"name":"Desert Eagle","rawName":"deagle","kills":5086,"rawKills":5086}],"favMap":{"rawName":"de_dust2_new","name":"Dust II","rounds":"14,819","rawRounds":14819},"favMaps":[{"rawName":"de_inferno_new","name":"Inferno","rounds":7604,"rawRounds":7604},{"rawName":"de_nuke_new","name":"Nuke","rounds":2476,"rawRounds":2476},{"rawName":"de_train","name":"Train","rounds":1477,"rawRounds":1477},{"rawName":"de_cbble","name":"Cobble","rounds":1184,"rawRounds":1184},{"rawName":"cs_office","name":"Office","rounds":377,"rawRounds":377},{"rawName":"de_lake","name":"Lake","rounds":260,"rawRounds":260}],"accuracy":"20.7%","hsp":"37.4%","weaponKills":[{"name":"Zeus x27","value":44},{"name":"Molotov","value":143},{"name":"Galil AR","value":1091},{"name":"M4A1-S and M4A4","value":14522},{"name":"MAG-7","value":406},{"name":"Tec-9","value":1156},{"name":"PP-Bizon","value":794},{"name":"Sawed-Off","value":273},{"name":"Negev","value":357},{"name":"Nova","value":569},{"name":"MP9","value":323},{"name":"MP7","value":960},{"name":"SSG 08","value":2168},{"name":"SCAR-20","value":279},{"name":"SG 553","value":1105},{"name":"P250","value":2220},{"name":"USP-S & P2000","value":6197},{"name":"M249","value":256},{"name":"G3SG1","value":238},{"name":"FAMAS","value":1581},{"name":"AUG","value":1483},{"name":"AK-47","value":30485},{"name":"AWP","value":24078},{"name":"P90","value":1040},{"name":"UMP-45","value":666},{"name":"MAC-10","value":561},{"name":"XM1014","value":368},{"name":"Five-SeveN","value":1138},{"name":"Dual Berettas","value":237},{"name":"Desert Eagle","value":5086},{"name":"Glock-18","value":3379},{"name":"HE Grenade","value":509},{"name":"Knife","value":2261}],"mapsPlayed":[{"name":"cs_militia","value":78},{"name":"de_vertigo","value":28},{"name":"ar_monastery","value":14},{"name":"ar_baggage","value":14},{"name":"ar_shoots","value":24},{"name":"de_shorttrain","value":136},{"name":"de_bank","value":98},{"name":"de_stmarc","value":35},{"name":"de_sugarcane","value":11},{"name":"de_safehouse","value":102},{"name":"de_lake","value":260},{"name":"de_train","value":1477},{"name":"de_nuke","value":2476},{"name":"de_inferno","value":7604},{"name":"de_dust","value":214},{"name":"de_dust2","value":14819},{"name":"de_cbble","value":1184},{"name":"de_aztec","value":165},{"name":"cs_office","value":377},{"name":"cs_italy","value":170},{"name":"cs_assault","value":246}],"bestWeapon":"AK-47","favoriteMap":"de_dust2","winRate":"51.0%","kills":105975,"deaths":83724,"kdr":"1.27","friends":[{"steamid":"76561198037090067","personaname":"Dail","avatar":"https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/35/350233c86efd13c4bfb79b6cf8aeab1cf4674685_full.jpg","rank":15,"rank_title":"Legendary Eagle"},{"steamid":"76561198007477326","personaname":"PootisMan","avatar":"https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/13/13224ce25f89fb850c6b95c4394ff36f8e013496_full.jpg","rank":14,"rank_title":"Dist. Master Guardian"}]}');

        $stats = new Statistics();
        $stats->stats = $tmp;
        $stats->discipline_id = 1;
        $stats->user_id = 1;
        $stats->save();
    }
}
