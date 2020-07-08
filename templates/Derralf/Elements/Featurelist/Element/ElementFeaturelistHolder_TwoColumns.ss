
<% if $ShowTitle %>
    <% include Derralf\\Elements\\Featurelist\\Title %>
<% end_if %>

<% if $HTML %>
    <div class="element__content">$HTML</div>
<% end_if %>

<% if $Features %>
    <div class="featurelist-wrapper <% if $UseToggleButton %>featurelist-toggled<% end_if %>">

        <% if $UseToggleButton %>
            <div class="btn-featurelist-toggle">
                <span class="btn btn-primary btn-lg"><% if $ToggleButtonLabel %>$ToggleButtonLabel<% else %><%t Derralf\\Elements\\Fearurelist\\Element\\ElementFeatureListHolder.ToggleButtonDefaultLabel 'show Features' %><% end_if %> <i class="fa fa-chevron-down"></i></span>
            </div>
            <% require javascript("derralf/elemental-featurelist:client/dist/js/elemental-featurelist.js") %>
        <% end_if %>

        <div class="featurelist">
            <div class="row row-eq-height">
                <% loop $Features %>

                    <% include Derralf\\Elements\\Featurelist\\Includes\\ElementFeatureListItem ColCss=col-sm-6 %>

                <% end_loop %>
            </div>
        </div>
    </div>
<% end_if %>
