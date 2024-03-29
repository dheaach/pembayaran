<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>HTML DOM - Resize columns of a table</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="/css/demo.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com"/>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Inter&family=Source+Code+Pro&display=swap"
        />
        <style>
            .tbl-rz {
                border-collapse: collapse;
            }
            .tbl-rz,
            .tbl-rz th,
            .tbl-rz td {
                border: 1px solid #ccc;
            }
            .tbl-rz th,
            .tbl-rz td {
                padding: 0.5rem;
            }
            .tbl-rz th {
                position: relative;
            }
            .resizer {
                position: absolute;
                top: 0;
                right: 0;
                width: 5px;
                cursor: col-resize;
                user-select: none;
            }
            .resizer:hover,
            .resizing {
                border-right: 2px solid blue;
            }

            .resizable {
                border: 1px solid gray;
                height: 100px;
                width: 100px;
                position: relative;
            }
        </style>
    </head>
    <body>
        <table id="table-id" class="tbl-rz">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>First name</th>
                    <th>Last name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Andrea</td>
                    <td>Ross</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Penelope</td>
                    <td>Mills</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Sarah</td>
                    <td>Grant</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Vanessa</td>
                    <td>Roberts</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Oliver</td>
                    <td>Alsop</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Jennifer</td>
                    <td>Forsyth</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Michelle</td>
                    <td>King</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Steven</td>
                    <td>Kelly</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Julian</td>
                    <td>Ferguson</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Chloe</td>
                    <td>Ince</td>
                </tr>
            </tbody>
        </table>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const createResizableTable = function (table) {
                    const cols = table.querySelectorAll('th');
                    [].forEach.call(cols, function (col) {
                        // Add a resizer element to the column
                        const resizer = document.createElement('div');
                        resizer.classList.add('resizer');

                        // Set the height
                        resizer.style.height = `${table.offsetHeight}px`;

                        col.appendChild(resizer);

                        createResizableColumn(col, resizer);
                    });
                };

                const createResizableColumn = function (col, resizer) {
                    let x = 0;
                    let w = 0;

                    const mouseDownHandler = function (e) {
                        x = e.clientX;

                        const styles = window.getComputedStyle(col);
                        w = parseInt(styles.width, 10);

                        document.addEventListener('mousemove', mouseMoveHandler);
                        document.addEventListener('mouseup', mouseUpHandler);

                        resizer.classList.add('resizing');
                    };

                    const mouseMoveHandler = function (e) {
                        const dx = e.clientX - x;
                        col.style.width = `${w + dx}px`;
                    };

                    const mouseUpHandler = function () {
                        resizer.classList.remove('resizing');
                        document.removeEventListener('mousemove', mouseMoveHandler);
                        document.removeEventListener('mouseup', mouseUpHandler);
                    };

                    resizer.addEventListener('mousedown', mouseDownHandler);
                };

                createResizableTable(document.getElementById('table-id'));
            });
        </script>
    </body>
</html>