"use strict"
window.onload = function () {
    
    $.getJSON('http://ip-kuznetsov.loc/rest/matches/view?id=1', function(data) {
        let json_data = JSON.parse(data['data']);
        
        let match_board = document.getElementById('match-data');

        for (let key in json_data) {
            if (key === 'title') {
                document.title = json_data[key]
                match_board.innerHTML += '<h2>' + json_data[key] + '</h2>';
            }

            if (key === 'bets') {
                let bets = json_data[key];
                let html = '';
                for (let key in bets) {
                    let bet_group = bets[key];

                    switch (key) {
                        case '1':
                            html += '<p class="btn btn-primary">1х2</p>';
                            for (let key in bet_group) {
                                html += '<div class="row">';
                                html += '<div class="col-xs-1"><div class="mini-box">' + bet_group[key]['S'] + '</div></div>';
                                html += '<div class="col-xs-1"><div class="mini-box">-</div></div>';
                                html += '<div class="col-xs-1"><div class="mini-box">' + bet_group[key]['C'] + '</div></div>';
                                html += '</div>';
                            }
                            break;
                        case '7':
                            html += '<p class="btn btn-primary">Форы</p>';
                            html += '<div class="row">';
                            for (let key in bet_group) {
                                html += '<div class="col-xs-6"><p><strong>Фора ' + key + '</strong></p>';
                                for (let index in bet_group[key]) {
                                    html += '<div class="row">';
                                    html += '<div class="col-xs-3"><div class="mini-box">' + bet_group[key][index]['S'] + '</div></div>';
                                    html += '<div class="col-xs-2"><div class="mini-box">-</div></div>';
                                    html += '<div class="col-xs-2"><div class="mini-box">' + bet_group[key][index]['C'] + '</div></div>';
                                    html += '</div>';
                                }
                                html += '</div>';
                            }
                            html += '</div>';
                            break;
                        case '8':
                            html += '<p class="btn btn-primary">Тоталы</p>';
                            html += '<div class="row">';

                            let title_obj = {"1": 'Тотал больше', "2": 'Тотал меньше', "3": 'Кол-во мячей в матче'}

                            for (let key in bet_group) {
                                html += '<div class="col-xs-6"><p><strong>' + title_obj[key] + '</strong></p>';
                                for (let index in bet_group[key]) {
                                    html += '<div class="row">';
                                    html += '<div class="col-xs-3"><div class="mini-box">' + bet_group[key][index]['S'] + '</div></div>';
                                    html += '<div class="col-xs-2"><div class="mini-box">-</div></div>';
                                    html += '<div class="col-xs-2"><div class="mini-box">' + bet_group[key][index]['C'] + '</div></div>';
                                    html += '</div>';
                                }
                                html += '</div>';

                            }
                            html += '</div>';
                            break;
                        case '9':
                            html += '<p class="btn btn-primary">Другие ставки</p>';
                            for (let key in bet_group) {
                                html += '<div class="row">';
                                html += '<div class="col-xs-4"><div class="mini-box">' + bet_group[key]['S'] + '</div></div>';
                                html += '<div class="col-xs-1"><div class="mini-box">-</div></div>';
                                html += '<div class="col-xs-1"><div class="mini-box">' + bet_group[key]['C'] + '</div></div>';
                                html += '</div>';
                            }
                            break;
                    }
                }

                match_board.innerHTML += html
            }
        }
    });
    
    
//    let json_data = JSON.parse(match_data);
//

};
