$  = require 'jquery'
window._ = require('underscore')
Backbone = require('backbone')
Backbone.$ = $
Backbone.Marionette = require('backbone.marionette')
Backbone.Marionette.$ = Backbone.$

FeedTemplateBasic = '<div>
    <b><a href="#album/<%= id %>"><%= name %></a></b>
    <br/>
</div>'

App = new Backbone.Marionette.Application()
App.addRegions
  headerRegion: 'header'
  mainRegion: '#main'
App.addInitializer ->
  Backbone.history.start()

AppRouter = Backbone.Marionette.AppRouter.extend(appRoutes:
  '': 'feed'
  'album/:id':'AlbumDetails')

Album = Backbone.Model.extend(
    urlRoot: '/api/album/'
  defaults:
    id: ''
    name: ''
    images: '')

AlbumCollection = Backbone.Collection.extend(
  model: Album
  url: '/api/homepage')

FeedItemView = Backbone.Marionette.ItemView.extend(
  template: _.template(FeedTemplateBasic)
  displayMode: 'full'
  model: new Album({})
  initialize: (options) ->
    @model.listenTo this, 'sync', @render
    if options.itemId
      @model.set 'id', options.itemId
      @model.fetch()
    onRender: ->
      console.log(123)
)

FeedCollectionView = Backbone.Marionette.CollectionView.extend(
  tagName: 'ul'
  childView: FeedItemView
  filterString: null
  initialize: (options) ->
    @collection = new AlbumCollection()
    @collection.fetch()
  showCollection: ->
    self = this
    itemView = @getItemView()
    @collection.each (item, index) ->
      if self.filterString != null and (self.filterString.length == 0 or !self.filter(item))
        return
      self.addItemView item, itemView, index
  itemViewOptions: (model, index) ->
    { displayMode: 'short' }
)


AppController = Backbone.Marionette.Controller.extend(
  feed: ->
    App.mainRegion.show new FeedCollectionView()
  AlbumDetails: (albumId) ->
    App.mainRegion.show new FeedItemView({
      displayMode: 'full',
      itemId: albumId})
)

App.appRouter = new AppRouter(controller: new AppController())

App.start()


#rebindNavigation = ->
#  $('#paginationHtml A').click ->
#    $('#items tbody').remove()
#    url = $(this).attr('href')
#    loadData url
#    window.history.pushState '', '', url
#    false
#  return
#
#loadData = (url) ->
#  console.log(url)
#  $.getJSON url, (data) ->
## sample collection
#    collection = new (Backbone.Collection)(data.items)
#    view = new CollectionView(collection: collection)
#    # Render and append the view
#    $('#items').append view.render().el
#    $('#totalCount').text data.pagination.totalCount
#    $('#paginationHtml').html data.paginationHtml
#    rebindNavigation()
#
#loadData document.location.href
#
#$(window).bind 'popstate', ->
#  loadData document.location
