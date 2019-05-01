<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Menu-Template. Mit Toggler-Button für Smartphones.
 *
-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navigation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php echo $printmenu?>
        </ul>
    </div>
</nav>
